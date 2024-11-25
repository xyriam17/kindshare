<?php

namespace App\Http\Controllers\donations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donors;
use App\Models\Donations;
use App\Models\Inventory;
use Illuminate\Support\Facades\Validator;



class DonationController extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    return view('content.front-pages.donate', ['pageConfigs' => $pageConfigs]);
  }

  public function donateNow(Request $request)
  {
    $donation_type = $request->donation_type;
    if (empty($request->checkanonymous) || $request->checkanonymous == 0) {
      $validators = Validator::make($request->all(), [
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email',
        'contact_number' => 'required|string',
      ]);
      if ($validators->fails()) {
        return response()->json([
          'message' => 'Validation Error',
          'errors' => $validators->errors()
        ], 402);
      }
    }
    if ($donation_type == 'money') {
      return $this->moneyDonation($request);
    } else if ($donation_type == 'inkinds') {
      return $this->inkindDonation($request);
    } else {
      return $this->foodDonation($request);
    }
  }

  public function moneyDonation($request)
  {
    if (empty($request->amount)) {
      return response()->json([
        'message' => 'Validation Error',
        'errors' => [
          'amount' =>  ['The amount field is required.'],
        ]
      ], 402);
    }
    $client = new \GuzzleHttp\Client();
    try {
      $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
        'body' => '{"data":{"attributes":
            {"amount":' . $request->amount . '00, "description":"Donation","remarks":"Donation"}}}',
        'headers' => [
          'accept' => 'application/json',
          'authorization' => 'Basic c2tfdGVzdF9lb0Z5Wm5iQzd0TGdTYXo5WWlRV3lCWlM6',
          'content-type' => 'application/json',
        ],
      ]);
      $responseData = json_decode($response->getBody());
      $name = $request->firstname . ' ' . $request->lastname;
      $donor = new Donors();
      $donor->name = (!empty($name) ? $name : 'Anonymous');
      $donor->email = $request->email;
      $donor->contact_number = $request->contact_number;

      if ($donor->save()) {
        $donor_id = $donor->id;
        $donations = new Donations();
        $donations->donor_id = $donor_id;
        $donations->amount = $request->amount;
        $donations->reference_no = $responseData->data->attributes->reference_number;
        $donations->type = $request->donation_type;
        $donations->save();
        return response()->json(
          [
            'status' => 'success',
            'message' => 'Donation submitted successfully. You will be redirected to the payment page.',
            'payment_link' => $responseData->data->attributes->checkout_url,
          ]

        );
      }
      return response()->json(['errors' => 'Something went wrong'], 400);
    } catch (\GuzzleHttp\Exception\ClientException $e) {

      $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
      return response()->json(['errors' => $errorResponse['errors']], 400);
    }
  }
  public function inkindDonation($request)
  {
    $validator = Validator::make($request->all(), [
      'quantity' => 'required|integer',
      'description' => 'required|string',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'message' => 'Validation Error',
        'errors' => $validator->errors()
      ], 402);
    }
    $name = $request->firstname . ' ' . $request->lastname;
    $donor = new Donors();
    $donor->name = (!empty($name) ? $name : 'Anonymous');
    $donor->email = $request->email;
    $donor->contact_number = $request->contact_number;

    if ($donor->save()) {
      $donor_id = $donor->id;
      $donations = new Donations();
      $donations->donor_id = $donor_id;
      $donations->quantity = $request->quantity;
      $donations->type = 'clothing';
      $donations->description = $request->description;
      $donations->save();
      return response()->json(
        [
          'status' => 'success',
          'message' => 'Donation submitted successfully',
          'payment_link' => '',
        ]
      );
    }
  }
  public function foodDonation($request)
  {
    $validator = Validator::make($request->all(), [
      'food_quanity' => 'required|integer',
      'expiry' => 'required|date',
      'food_unit' => 'required|string',
      'food_description' => 'required|string',
    ]);
    if ($validator->fails()) {
      return response()->json([
        'message' => 'Validation Error',
        'errors' => $validator->errors()
      ], 402);
    }
    $name = $request->firstname . ' ' . $request->lastname;
    $donor = new Donors();
    $donor->name = (!empty($name) ? $name : 'Anonymous');
    $donor->email = $request->email;
    $donor->contact_number = $request->contact_number;

    if ($donor->save()) {
      $donor_id = $donor->id;
      $donations = new Donations();
      $donations->donor_id = $donor_id;
      $donations->quantity = $request->food_quanity;
      $donations->type = 'food';
      $donations->food_type = $request->food_type;
      $donations->unit = $request->food_unit;
      $donations->expiry_date = $request->expiry;
      $donations->description = $request->food_description;
      $donations->save();
      return response()->json(
        [
          'status' => 'success',
          'message' => 'Donation submitted successfully',
          'payment_link' => '',
        ]
      );
    }
  }

  public function moneyDonationlist()

  {
    $total_recieved = Donations::where('type', 'money')->where('status', 'paid')->sum('amount');
    $total_pending = Donations::where('type', 'money')->where('status', 'pending')->sum('amount');
    $total_failed = Donations::where('type', 'money')->where('status', 'failed')->sum('amount');
    return view('content.donations.money', compact('total_recieved', 'total_pending', 'total_failed'));
  }

  public function getMoneyDonation(Request $request)
  {
    $columns = [
      1 => 'id',
      2 => 'donor',
      3 => 'amount',
      4 =>  'payment',
      5 => 'date',
      5 => 'status',
    ];

    $search = [];

    $totalData = Donations::where('type', 'money')->count();

    $totalFiltered = $totalData;

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $moenyDonation = Donations::offset($start)
        ->where('type', 'money')
        ->limit($limit)
        ->orderBy('created_at', $dir)
        ->get();
    }

    $data = [];

    if (!empty($moenyDonation)) {

      $ids = $start;

      foreach ($moenyDonation as $donation) {
        $donor = Donors::where('id', $donation->donor_id)->first();
        $nestedData['id'] = $donation->id;
        $nestedData['fake_id'] = ++$ids;
        $nestedData['donor'] =  (!empty($donor->name && $donor) ? $donor->name : 'Anonymous');
        $nestedData['amount'] = $donation->amount;
        $nestedData['payment'] = 'GCASH';
        $nestedData['date'] = date('F d, Y h:i:s A', strtotime($donation->created_at));
        $nestedData['status'] = $donation->status;
        $data[] = $nestedData;
      }
    }

    if ($data) {
      return response()->json([
        'draw' => intval($request->input('draw')),
        'recordsTotal' => intval($totalData),
        'recordsFiltered' => intval($totalFiltered),
        'code' => 200,
        'data' => $data,
      ]);
    } else {
      return response()->json([
        'message' => 'Internal Server Error',
        'code' => 500,
        'data' => [],
      ]);
    }
  }
}

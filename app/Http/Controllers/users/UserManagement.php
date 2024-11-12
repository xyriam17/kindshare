<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Facades\Validator;



class UserManagement extends Controller
{
  /**
   * Redirect to user-management view.
   *
   */
  public function UserManagement()
  {
    // dd('UserManagement');
    $users = User::all();
    $userCount = $users->count();
    $verified = User::whereNotNull('email_verified_at')->get()->count();
    $notVerified = User::whereNull('email_verified_at')->get()->count();
    $usersUnique = $users->unique(['email']);
    $userDuplicates = $users->diff($usersUnique)->count();

    return view('content.users.user-management', [
      'totalUser' => $userCount,
      'verified' => $verified,
      'notVerified' => $notVerified,
      'userDuplicates' => $userDuplicates,
    ]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $columns = [
      1 => 'id',
      2 => 'name',
      3 => 'email',
      4 =>  'address',
      5 => 'contact_number',
      6 => 'role',
    ];

    $search = [];

    $totalData = User::count();

    $totalFiltered = $totalData;

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $users = User::offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->with('role')
        ->get();
    } else {
      $search = $request->input('search.value');

      $users = User::where('id', 'LIKE', "%{$search}%")
        ->orWhere('name', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->with('role')
        ->get();
      $totalFiltered = User::where('id', 'LIKE', "%{$search}%")
        ->orWhere('name', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->count();
    }

    $data = [];

    if (!empty($users)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($users as $user) {
        $nestedData['id'] = $user->id;
        $nestedData['fake_id'] = ++$ids;
        $nestedData['name'] = (empty($user->firtsname)) ? ($user->name) : ($user->firtsname . ' ' . $user->lastname);
        $nestedData['email'] = $user->email;
        $nestedData['address'] = $user->address;
        $nestedData['contact_number'] = $user->contact_number;
        $nestedData['role'] = $user->role ? $user->role->guard_name : 'N/A';
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



  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id): JsonResponse
  {
    $user = User::with('role')->findOrFail($id);
    return response()->json($user);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $userID = $request->id;

    $validatedData = $request->validate([
      'email' => 'required|unique:users',
    ]);

    $dataSubmitted = [];
    if (empty($userID)) {
      $validator = Validator::make($request->all(), [
        'email' => 'required|unique:users',
        'firtsname' => 'required|string|max:255',
        'middlename' => 'nullable|string|max:255',
        'lastname' => 'required|string|max:255',
        'contact_number' => 'required|string|max:20',
        'address' => 'required|string|max:500',
        'role_id' => 'required|integer|exists:roles,id',
      ]);

      if ($validator->fails()) {
        return response()->json([
          'message' => 'Validation Error',
          'errors' => $validator->errors()
        ], 422);
      }
    }

    $dataSubmitted = [
      'firtsname'       =>  $request->firtsname,
      'middlename'      =>  $request->middlename,
      'lastname'        =>   $request->lastname,
      'email'           =>   $request->email,
      'contact_number'  =>   $request->contact_number,
      'address'         =>   $request->address,
      'role_id'         =>   $request->role_id,
    ];
    if (empty($request->password)) {
      $dataSubmitted['password'] = bcrypt('123456');
    }
    $this->save_userdata($userID, $dataSubmitted);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $users = User::where('id', $id)->delete();
  }

  public function view($id)
  {
    $user = User::with('role')->findOrFail($id);
    return view('content.users.edit-user', compact('user'));
  }


  public function save_userdata($id, $data)
  {

    // Filter data and remove empty values to ensure only non empty data is being save in the datebase
    $filteredData = array_filter($data, function ($value) {
      return !empty($value);
    });

    $user =  new User();

    if (!empty($id)) {
      $user =  User::find($id);
    }
    foreach ($filteredData as $key => $value) {
      $user->$key = $value;
    }

    if ($user->save()) {
      return response()->json('Update');
    }

    return response()->json(['message' => 'Something went wrong', 'error' => 'Please try again later'], 402);
  }
}

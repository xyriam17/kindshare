<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Donations;
use App\Models\RunningBalance;

class CheckPaymentStatus extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'donations:check-payment-status';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command description';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $pendingDonations = Donations::where('status', 'pending')->where('type', 'money')->get();

    $client = new \GuzzleHttp\Client();
    foreach ($pendingDonations as $donation) {

      $response = $client->request('GET', 'https://api.paymongo.com/v1/links?reference_number=' . $donation->reference_no, [
        'headers' => [
          'accept' => 'application/json',
          'authorization' => 'Basic c2tfdGVzdF9lb0Z5Wm5iQzd0TGdTYXo5WWlRV3lCWlM6',
        ],
      ]);

      $responseData = json_decode($response->getBody());

      $status =  $responseData->data[0]->attributes->status;

      $dt = strtotime($donation->created_at . ' + 5 minutes');
      $newDate = date('Y-m-d H:i:s', $dt);

      if ($status === 'paid') {
        $donation->update(['status' => 'paid']);
        $runningBalance = RunningBalance::where('balance_type', 'money')->first();

        $runningBalance->update(['previous_balance' =>   $runningBalance->current_balance,  'current_balance' => $runningBalance->current_balance + $donation->amount]);
      } elseif ($status === 'failed') {
        $donation->update(['status' => 'failed']);
      }
      if ($donation->created_at < $newDate &&  $donation->status === 'pending') {
        $donation->update(['status' => 'failed']);
      }
    }
    $this->info('Payment status check completed.');
  }
}

<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SMSChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $phone = Str::startsWith($notifiable->phone_number, '0')
            ? '88'.$notifiable->phone_number
            : Str::replaceFirst('+', '', $notifiable->phone_number);

//        dd(Http::get('http://sms.bdwebs.com/smsapi?api_key='.config('services.bdwebs.api_key').'&type=text&contacts=8801783110247&senderid='.config('services.bdwebs.senderid').'&msg="Your OTP for BSBazarBD is: 123465."')->body());
//        dd(Http::get('http://sms.bdwebs.com/miscapi/'.config('services.bdwebs.api_key').'/getDLR/getAll')->body());

        // Send notification to the $notifiable instance...
        $data = array_merge([
            'number' => $phone,
            'password' => config('services.bdwebs.api_key'),
            'username' => config('services.bdwebs.senderid'),
        ], $notification->toArray($notifiable));

	$this->send_sms($data);
  //      Log::info($this->send_sms($data));
    }

    private function send_sms($data)
    {
        // Log::info('sending sms:', $data);
        // $url = "http://66.45.237.70/api.php";
        
        // Http::
        // $ch = curl_init(); // Initialize cURL
        // curl_setopt($ch, CURLOPT_URL,$url);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $response = curl_exec($ch);
        // info($response, $data);
        // curl_close($ch);
        // return $response;
        
        $message = urlencode($data['message']);
        $url = "http://66.45.237.70/api.php?username={$data['username']}&password={$data['password']}&number={$data['number']}&message={$message}";
        $response = Http::get($url);
    }
}

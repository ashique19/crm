<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Models\User;
use DB;
use Carbon\Carbon;


class AppointmentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:appointment_reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Appointment reminder notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = \Carbon\Carbon::now()->toDateTimeString();
        $appointments = DB::table('appointments')
            ->select('appointments.*', 'appointments.id as apt_id', 'appointment_availability.*')
            ->join('appointment_availability', 'appointments.appointment_availability_id', '=', 'appointment_availability.id')
            ->whereDate('appointment_availability.availability', '>=', $now)
            ->where(
                function ($query) {
                    $query->where('email_notification', '1')
                        ->orWhere('sms_notification', '1');
                }
            )
            ->get();
        
        foreach ($appointments as $value) {
            $data = [
              'user_id'      => $value->user_id,
              'first_name'   => $value->first_name,
              'last_name'    => $value->last_name,
              'email'        => $value->email,
              'phone'        => $value->phone,
              'availability' => $value->availability,
            ];

            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $value->availability);
            $from = \Carbon\Carbon::now()->toDateTimeString();
            $diff_in_hours = $to->diffInHours($from);
            
            // echo $diff_in_hours.''.PHP_EOL;
            // exit; 
          
            if($diff_in_hours <= '24') {
                if($value->email_sent == '0' && $value->email_notification == '1') {
                    Mail::send(
                        'emails.appointment_reminder', ['data'=>$data], function ($message) use ($value) {
                            $message->to($value->email)->subject('Appointment reminder notification!');
                        }
                    );
                     DB::table('appointments')
                         ->where('id', $value->apt_id)
                         ->update(['email_sent' => '1']);
                }
                if($value->sms_sent == '0' && $value->sms_notification == '1') {
                    $sender      = getenv('PLIVO_SENDER');
                    $auth_id     = getenv('PLIVO_AUTH_ID');
                    $auth_token  = getenv('PLIVO_AUTH_TOKEN');
                    $dst         = $value->phone;
                    $dst         = preg_replace('/\D+/', '', $dst);
                    $msg         = 'This is a reminder that you have an appointment with '.$data['first_name'].' '. $data['last_name'].' on '.$data['availability'].'';
                    
                    $endpoint    = "https://api.plivo.com/v1/Account/".$auth_id."/Message/";
                    $client      = new \GuzzleHttp\Client();
                    $form_params = ['src'=>$sender,'dst'=>$dst,'text'=>$msg];

                    $response = $client->request('POST', $endpoint, ['form_params'=>$form_params,'auth' => [$auth_id, $auth_token]]);
                    DB::table('appointments')
                        ->where('id', $value->apt_id)
                        ->update(['sms_sent' => '1']);

                }
            }
        }
        $this->info('Appointment reminder notification sent successfully!');
    }
}
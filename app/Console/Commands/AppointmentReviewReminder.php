<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Auth;
use Mail;
use App\Models\User;
use DB;
use Carbon\Carbon;
class AppointmentReviewReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:appointment_review_reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Appointment review reminder notification!';

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
        $selected_users = DB::select("SELECT email,id,user_id FROM appointments WHERE appointment_availability_id IN (SELECT id FROM appointment_availability WHERE availability < '".$now."') AND id NOT IN (SELECT appointment_id FROM appointment_reviews)");
       
        foreach ($selected_users as $value) {
            $website_name = DB::table('websites')
                ->select('primary_domain')
                ->where('user_id', $value->user_id)
                ->first();  
            $data = [
              'appointment_id' => $value->id,
              'email'        => $value->email,
              'primary_domain'=> $website_name->primary_domain ,
              'link'=> 'https://'.$website_name->primary_domain.'/review.html?appointment_id='.$value->id
            ];
            
            Mail::send(
                'emails.appointment_review_reminder', ['data'=>$data], function ($message) use ($value) {
                        $message->to($value->email)->subject('Appointment review reminder notification!');
                }
            );
           
        }   
            
    }
}

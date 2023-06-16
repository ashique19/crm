<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentNoAvailabilityReminderEmail;
use DB;

class AppointmentNoAvailabilityReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:appointment_no_availability_reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminding each user that we doesn\'t have active availability every night';

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
        $tousers = DB::select('SELECT * FROM users WHERE activated = :act AND id NOT IN (SELECT user_id FROM appointment_availability WHERE availability > NOW())', ['act' => 1]);

        $emails = [];

        foreach ($tousers as $key => $value) {
            $emails[] = $value->email;
        }


        if (count($tousers) > 0 ) {
            Mail::to($emails)->send(new NoAppointmentAvailabilityEmail());
            $this->info('Availability mail sent successfully!');
        }else{
            $this->info('No user found to send mail');
        }

    }
}

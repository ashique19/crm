<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;
use App\Models\User;
use Mail;

class CleanAvailabilty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:availabilty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean Availabilty Entries';

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
        $now = Carbon::now()->toDateTimeString();
        DB::delete('DELETE FROM appointment_availability WHERE availability < "'.$now.'" AND id NOT IN (SELECT appointment_availability_id FROM appointments)');
        $this->info('Appointment Availability has been cleaned successfully');
    }
}
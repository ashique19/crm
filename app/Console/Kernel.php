<?php
namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\ArticleBuilder::class,
        // Commands\ArticleBuilderBackup::class,
        // Commands\ArticleBuilderTips::class,
        // Commands\CleanAvailabilty::class,
        // Commands\SitemapGenerate::class,
        // Commands\AppointmentReminder::class,
        // Commands\AppointmentReviewReminder::class,    
        // Commands\AppointmentNoAvailabilityReminder::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('command:article_builder')->monthlyOn(1, setting('site.cron_run_time'));
        // $schedule->command('command:article_builder_backup')->dailyAt(str_replace("00", "10", setting('site.cron_run_time')));
        // $schedule->command('command:article_builder_tips')->dailyAt(str_replace("00", "20", setting('site.cron_run_time')));
        // $schedule->command('sitemap:generate')->weeklyOn(1, str_replace("00", "30", setting('site.cron_run_time')));
        // $schedule->command('clean:availabilty')->dailyAt(str_replace("00", "40", setting('site.cron_run_time')));
        // $schedule->command('command:appointment_reminder')->everyMinute();
        // $schedule->command('command:appointment_no_availability_reminder')->daily();
        // $schedule->command('command:appointment_review_reminder')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // $this->load(__DIR__.'/Commands');

        // include base_path('routes/console.php');
    }
}

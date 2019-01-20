<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\MailReportSchedule;
use App\Models\Course;
class SendMailSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $courses = Course::where('status',1)->get();
        foreach ($courses as $course) {
            $users = $course->users()->get()->groupBy('pivot.user_id');
            foreach ($users as $user) {
                $email = new MailReportSchedule($user->first(), $course);
                Mail::to($user->first()->email)->send($email);
            }
        }
    }
}

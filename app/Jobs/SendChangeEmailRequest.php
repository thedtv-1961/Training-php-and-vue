<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChangeEmailRequestMailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendChangeEmailRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mailType;
    protected $mailTo;
    protected $mailTitle;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param  int  $mailType
     * @param  string  $mailTo
     * @param  string  $mailTitle
     * @param  User  $user
     */
    public function __construct($mailType ,$mailTo, $mailTitle, $user)
    {
        $this->mailType = $mailType;
        $this->mailTo = $mailTo;
        $this->mailTitle = $mailTitle;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->mailTo)
            ->queue((new ChangeEmailRequestMailer($this->mailType, $this->mailTitle, $this->user))
                ->onConnection('database'));
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        report($exception);
    }
}

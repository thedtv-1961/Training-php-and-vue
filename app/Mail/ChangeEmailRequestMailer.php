<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangeEmailRequestMailer extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailType;
    protected $mailTitle;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @param  int  $mailType
     * @param  string  $mailTitle
     * @param  User  $user
     */
    public function __construct($mailType, $mailTitle, $user)
    {
        $this->mailType = $mailType;
        $this->mailTitle = $mailTitle;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->mailType == config('change_email_requests.mail_type.approve')) {
            return $this->view('emails.approve_email_request', ['user' => $this->user])
                ->subject(trans($this->mailTitle));
        } else {
            return $this->view('emails.reject_email_request', ['user' => $this->user])
                ->subject(trans($this->mailTitle));
        }
    }
}

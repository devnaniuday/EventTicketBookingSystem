<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $otp;
    public $subject;

    public function __construct($otp, $subject)
    {
        $this->otp = $otp;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->view('mail.test')->with(['otp' => $this->otp, 'subject' => $this->subject]);
    }
}

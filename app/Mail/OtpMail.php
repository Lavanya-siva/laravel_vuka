<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $otp;
    public $subjectLine;

    public function __construct($user, $otp,$subjectLine=null)
    {
        $this->user = $user;
        $this->otp  = $otp;
        $this->subjectLine = $subjectLine ?? 'Your OTP Verification Code';
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('emails.otp-verification');
    }
}

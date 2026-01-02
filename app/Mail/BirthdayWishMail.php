<?php 
namespace App\Mail;

use Illuminate\Mail\Mailable;

class BirthdayWishMail extends Mailable
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject(' Happy Birthday!!! ')
                    ->view('emails.birthday_wish');
    }
}

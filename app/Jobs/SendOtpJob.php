<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;      
use App\Models\User;       

class SendOtpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;        // Number of attempts
    public $timeout = 30;     // Seconds before job times out

    protected $user;          // Full User object
    protected $otp;
    protected $subjectLine;

    public function __construct(User $user, $otp, $subjectLine=null)
    {
        $this->user = $user;
        $this->otp = $otp;
        $this->subjectLine = $subjectLine;
    }

    public function backoff()
    {
        return [60, 120]; // Retry after 60s then 120s
    }

    public function handle()
    {
        Mail::to($this->user->email)->send(
            new OtpMail($this->user, $this->otp,$this->subjectLine)
        );
    }
}

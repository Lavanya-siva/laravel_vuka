<?php 
namespace App\Jobs;

use App\Models\PersonalInfo;
use App\Mail\BirthdayWishMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Queue\Queueable;

class SendBirthdayEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $today = now();

        $personalInfos = PersonalInfo::whereMonth('date_of_birth', $today->month)
            ->whereDay('date_of_birth', $today->day)
            ->whereYear('date_of_birth', $today->year)
            ->with('user') //calls method in personalInfoController
            ->get();

        foreach ($personalInfos as $info) {
            if ($info->user && $info->user->email) {
                Mail::to($info->user->email)
                    ->send(new BirthdayWishMail($info->user));
            }
        }
    }
}

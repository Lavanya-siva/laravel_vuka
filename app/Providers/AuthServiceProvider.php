<?php 
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider{ 
public function boot(): void
{
    VerifyEmail::toMailUsing(function ($notifiable, $url) {

        $otp = $notifiable->email_otp ?? 'Not generated';

        return (new MailMessage)
            ->subject('Verify your VUKA account')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Thank you for registering with VUKA.')
            ->line('Use the OTP below to verify your email address:')
            ->line('OTP: ' . $otp)
            ->line('This OTP is valid for 10 minutes.')
            ->line('If you did not create this account, no action is required.')
            ->salutation('Regards, VUKA Team');
    });
}
}
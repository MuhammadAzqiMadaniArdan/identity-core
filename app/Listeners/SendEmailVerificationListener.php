<?php

namespace App\Listeners;

use App\Events\SendEmailVerification;
use App\Mail\EmailVerificationTemplate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class SendEmailVerificationListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(SendEmailVerification $event): void
    {
        $email = $event->user->email;
        $verificationURL = URL::temporarySignedRoute("verification.verify",now()->addMinutes(60),[
            "id" => $event->user->id,
            "hash" => sha1($event->user->email)
        ]);
        Mail::to($email)->send(new EmailVerificationTemplate($verificationURL));
    }
}

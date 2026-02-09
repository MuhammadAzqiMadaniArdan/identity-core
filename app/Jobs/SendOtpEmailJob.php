<?php

namespace App\Jobs;

use App\Mail\EmailOtpTemplate;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOtpEmailJob implements ShouldQueue
{
    use Dispatchable,Queueable,InteractsWithQueue;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $email,public int $code)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Sedang Menjalankan Job Send Email");
        Mail::to($this->email)->send(new EmailOtpTemplate($this->code));
    }
}

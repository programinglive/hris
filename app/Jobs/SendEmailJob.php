<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Queueable;

    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = [
            'recipient' => $this->user->email,
            'sender' => env('MAIL_FROM_ADDRESS'),
            'email' => $this->user->email,
            'password' => 'password',
            'name' => $this->user->name,
            'company_name' => $this->user->details->company_name,
        ];

        Mail::to($this->user)->send(new WelcomeEmail($data));
    }
}

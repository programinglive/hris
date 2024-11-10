<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Queueable;

    protected $email;

    /**
     * Create a new job instance.
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = [
            'recipient' => $this->email,
            'sender' => env('MAIL_FROM_ADDRESS'),
            'email' => $this->email,
            'password' => 'password'
        ];
        
        Mail::to($this->email)->send(new WelcomeEmail($data));
    }
}
<?php

namespace App\Mail;

use App\User;
use App\Verification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    protected $verification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Verification $verification)
    {
        $this->user = $user;
        $this->verification = $verification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Welcome to This")->view('mails.verify', [
            'user' => $this->user,
            'verification' => $this->verification
        ]);
    }
}

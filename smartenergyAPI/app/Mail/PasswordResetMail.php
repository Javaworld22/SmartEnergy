<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use OgaBoss\Modules\Auth\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use OgaBoss\Modules\Auth\Models\PasswordReset as PasswordResetModel;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, PasswordResetModel $passwordResetModel)
    {
        $this->user = $user;
        $this->passwordResetModel = $passwordResetModel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.passwordReset')->subject('Reset OgaBoss Password')->with([
            'url'=> env('OGA_BOSS_PASSWORD_RESET_URL').'?token='.$this->passwordResetModel->token
        ]);
    }
}

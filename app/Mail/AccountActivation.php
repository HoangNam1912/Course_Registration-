<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


class AccountActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
   
    public function __construct(User $user)
    {
        $this->user = $user;
    }

   
    public function build()
    {
        return $this->view('email.activation')
                    ->subject('Kích hoạt Tài khoản của bạn')
                    ->with(['user' => $this->user]);
    }
}

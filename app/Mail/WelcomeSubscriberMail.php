<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeSubscriberMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('Debook | Chào mừng bạn đến với cộng đồng Ebook')
                    ->view('pages.user.mail');
    }
}

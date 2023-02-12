<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactsSendmail extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $email;
    private $phone_number;
    private $title;
    private $body;

    public function __construct( $inputs )
    {
        $this->name = $inputs['name'];
        $this->email = $inputs['email'];
        $this->phone_number = $inputs['phone_number'];
        $this->title = $inputs['title'];
        $this->body = $inputs['body'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('example@gmail.com')
            ->subject('自動送信メール')
            ->view('contact.mail')
            ->with([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'title' => $this->title,
            'body' => $this->body,
            ]);
    }
}

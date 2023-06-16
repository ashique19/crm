<?php

namespace App\Mail\Contact;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($form)
    {
        $this->data = $form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->view('emails.contact_form')
            ->subject($this->data['subject'])
            ->with(
                [
                            'name' => $this->data['name'],
                            'email' => $this->data['email'],
                            'subject' => $this->data['subject'],
                            'bodyMessage' => $this->data['message'],
                        ]
            );
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class DemoMail extends Mailable
{
    use Queueable, SerializesModels;
    public $maildata;
    /**
     * Create a new message instance.
     */
    public function __construct($maildata)
    {
        $this->maildata = $maildata;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demo Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'user.email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {   
        if(!empty($this->maildata['file'])){
            return [
                Attachment::fromPath($this->maildata['file'])
            ];
        }
        else{
            return [
                // Attachment::fromPath($this->file)
            ];
        }
       
    }
    public function build()
    {  
         if (!empty($this->maildata['emailArray'])) {
            return  $this->view('user.email')->cc($this->maildata['emailArray']);
            }
        
    }
}

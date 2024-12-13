<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

/**
* Sign Up Mail
*
* Envelope, Content and Attachment Functions for creating a new customer sign up email
*
* @access   public
*/
class SignUp extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * Get the message envelope.
    *
    * @subject  subject header of the Mail
    * @from     default email sender and email preview message
    */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vielen Dank für Ihre Anmeldung',
            from: new Address('zuerich@projekt-restwert.ch', 'Anmeldung und AGBs'),
        );
    }

    /**
    * Get the message content and paste customer data such as email, name and surname
    */
    public function content(): Content
    {
        return new Content(
            view: 'form.signupEmail',
        );
    }


    /**
    * Get the file(s) and attach to the email
    *
    * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    */
    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path('\file\AGBs.pdf'))
       ];
    }
}

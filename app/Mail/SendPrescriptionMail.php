<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

use Illuminate\Queue\SerializesModels;


class SendPrescriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $prescriptionDetails;
    /**
     * Create a new message instance.
     */
    public function __construct($prescriptionDetails)
    {
        $this->prescriptionDetails = $prescriptionDetails;
    }




    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Prescription Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.send-prescreption',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

     /**
     * Build the message.
     *
     * @return [type]
     */
    public function build()
{
    return $this->to($this->prescriptionDetails->email)
                ->subject('Prescription')
                ->markdown('mail.send-prescreption', ['prescriptionDetails' => $this->prescriptionDetails]);
}

}

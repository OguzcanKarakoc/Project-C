<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'saquib.rizwan@cloudways.com';

        $name = 'Jasper Mourik';

        $subject = 'Test';

        return $this->view('resources/views/page/front-end/contact/email.blade.php')
                     ->from($address, $name)
                     ->subject($subject);

    }
}

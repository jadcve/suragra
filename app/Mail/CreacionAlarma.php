<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreacionAlarma extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'info@suragra.com';
        $name = 'Alarmas';

        Log::debug($this->data);
        return $this->subject($this->data['subject'])
            ->from($address, $name)
            ->view('mails.test')
            ->with([
                'test_message'  => $this->data['message'],
                'test_id'       => $this->data['alarmaId'],
                'test_titulo'   => $this->data['nombreAlarma'],
             ]);
    }
}

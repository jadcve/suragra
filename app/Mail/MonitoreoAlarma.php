<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MonitoreoAlarma extends Mailable
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
        $address = 'alain.diaz.2612@gmail.com';
        $name = 'Monitoreo Alarmas Suragra';


        return $this->subject($this->data['alarmaSubject'])
            ->from($address, $name)
            ->view('mails.monitoreo')
            ->with([
                'test_message'  => $this->data['alarmaDesc']
            ]);
    }
}

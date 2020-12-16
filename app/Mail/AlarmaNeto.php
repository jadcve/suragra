<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlarmaNeto extends Mailable
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

        return $this->subject($this->data['alarmaSubject'])
            ->from($address, $name)
            ->view('mails.alarmaNeto')
            ->with([
                'alarmaIva_empresa'  => $this->data['alarmaEmpresa'],
                'alarmaIva_message'  => $this->data['alarmaContenido'],
                'cuentas'            => $this->data['cuentas']
            ]);
    }
}

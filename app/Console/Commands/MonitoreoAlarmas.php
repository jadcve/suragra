<?php

namespace App\Console\Commands;

use App\Mail\AlarmaIva;
use App\Mail\MonitoreoAlarma;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MonitoreoAlarmas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitoreo:alarmas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $data = [
            'alarmaDesc'      => 'Alarma Activa',
            'alarmaSubject'         =>  'alain.diaz.2612@gmail.com'
        ];

        Mail::to($data['alarmaSubject'])->send(new MonitoreoAlarma($data));


    }
}

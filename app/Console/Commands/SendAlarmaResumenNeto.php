<?php

namespace App\Console\Commands;


use App\Mail\AlarmaIva;
use App\Models\Alarma;
use App\Models\Cuenta;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlarmaNeto;

class SendAlarmaResumenNeto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alarma:neto';

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
        $alarma = Alarma::select()
            ->join('alarma_users','alarma_users.alarma_id','alarmas.alarma_id')
            ->join('users','users.user_id','alarma_users.user_id')
            ->join('empresas','empresas.empresa_id','users.empresa_id')
            ->where('alarmas.alarma_id',2)
            ->get();

        $cuentas = Cuenta::all();


        foreach($alarma as $al)
        {

            $data = [
                'alarmaNombre'      => $al->alarma_nombre,
                'alarmaSubject'     => $al->alarma_subject,
                'alarmaContenido'   => $al->alarma_contenido,
                'cuentas'           => $cuentas,
                'alarmaEmpresa'     => $al->empresa_nombre
            ];

            Mail::to($al->email)->send(new alarmaNeto($data));

        }
    }
}

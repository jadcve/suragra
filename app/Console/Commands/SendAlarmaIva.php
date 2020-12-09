<?php

namespace App\Console\Commands;

use App\User;
Use App\Models\Alarma;
use App\Models\Cuenta;
use Illuminate\Console\Command;

class SendAlarmaIva extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alarma:iva';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alarma de notificacion de cobro de IVA';

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
        ->where('alarmas.alarma_id',23)
        ->get();

        $cuentas = Cuenta::all();

        return 0;
    }
}

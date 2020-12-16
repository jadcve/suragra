<?php

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
            'estado_tipo' => 'Activo'
        ]);

        Estado::create([
            'estado_tipo' => 'Inactivo'
        ]);
    }
}

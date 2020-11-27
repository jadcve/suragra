<?php

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'empresa_nombre'    => 'Diaz & Cia SPA',
            'empresa_rut'       => '16369332-5',
            'empresa_direccion' => 'San Nicolas 1425, San Miguel',
            'empresa_telefono'  => '+56991364514',
        ]);
    }
}

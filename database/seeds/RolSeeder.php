<?php

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'rol_nombre' => 'Administrador',
        ]);

        Rol::create([
            'rol_nombre' => 'Cliente',
        ]);
    }
}

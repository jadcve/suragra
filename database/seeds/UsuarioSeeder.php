<?php

use App\User;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'user_nombre'   =>  'Alain',
            'user_apellido' =>  'Diaz',
            'user_rut'      =>  '26506613-5',
            'user_cargo'    =>  'Desarrollador',
            'email'         =>  'jadcve@gmail.com',
            'password'      =>  bcrypt('123456789'),
            'rol_id'        =>  '1',
            'empresa_id'    =>  '1',
            'estado_id'     =>  '1',
        ]);

        User::create([
            'user_nombre'   =>  'Dahiana',
            'user_apellido' =>  'Grandon',
            'user_rut'      =>  '26506613-5',
            'user_cargo'    =>  'Gestión de control y comercialización',
            'email'         =>  'dahiana@suragra.com',
            'password'      =>  bcrypt('123456789'),
            'rol_id'        =>  '1',
            'empresa_id'    =>  '1',
            'estado_id'     =>  '1',
        ]);
    }
}

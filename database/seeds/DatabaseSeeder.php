<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolSeeder::class);
         $this->call(PeriodicidadSeeder::class);
         $this->call(EstadoSeeder::class);
         $this->call(EmpresaSeeder::class);
         $this->call(UsuarioSeeder::class);
    }
}

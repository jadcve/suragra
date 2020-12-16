<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PeriodicidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periodicidads')->insert([
        	'periodicidad_tipo' => 'Diaria',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);

        DB::table('periodicidads')->insert([
        	'periodicidad_tipo' => 'Semanal',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);

        DB::table('periodicidads')->insert([
        	'periodicidad_tipo' => 'Quincenal',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);

        DB::table('periodicidads')->insert([
        	'periodicidad_tipo' => 'Mensual',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);

        DB::table('periodicidads')->insert([
        	'periodicidad_tipo' => 'Trimestral',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);

        DB::table('periodicidads')->insert([
        	'periodicidad_tipo' => 'Semestral',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);

        DB::table('periodicidads')->insert([
        	'periodicidad_tipo' => 'Anual',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
    }
}

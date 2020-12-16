<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlarmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alarmas', function (Blueprint $table) {
            $table->id('alarma_id');
            $table->string('alarma_nombre');
            $table->string('alarma_subject');
            $table->longText('alarma_contenido');
            $table->unsignedBigInteger('periodicidad_id');
            $table->foreign('periodicidad_id')->references('periodicidad_id')->on('periodicidads')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alarmas');
    }
}

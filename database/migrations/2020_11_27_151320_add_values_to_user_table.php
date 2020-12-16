<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValuesToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('rol_id');
            $table->foreign('rol_id')->references('rol_id')->on('rols')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('empresa_id')->on('empresas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('estado_id')->on('estados')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['rol_id']);
            $table->dropForeign(['empresa_id']);
            $table->dropForeign(['estado_id']);
        });
    }
}

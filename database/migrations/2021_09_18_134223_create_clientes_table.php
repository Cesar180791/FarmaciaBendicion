<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente',150);
            $table->string('telefono',10);
            $table->string('NIT_cliente',20)->unique();
            $table->string('NRC_cliente',20)->unique();
            $table->enum('gran_con_cliente',['SI','NO']);
            $table->enum('estado_cliente',['ACTIVO','DESHABILITADO'])->default('ACTIVO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}

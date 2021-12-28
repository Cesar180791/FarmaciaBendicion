<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_proveedor',150);
            $table->string('nombre_vendedor',150);
            $table->string('telefono',10);
            $table->string('NIT',20)->unique();
            $table->string('NRC',20)->unique();
            $table->integer('gran_con');
            $table->enum('estado_proveedor',['ACTIVO','DESHABILITADO'])->default('ACTIVO');
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
        Schema::dropIfExists('proveedores');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) { 
            $table->id();
            $table->foreignId('products_id')->constrained();
            $table->foreignId('users_id')->constrained();
            $table->string('numero_lote',200);
            $table->integer('existencia_lote')->default(0);
            $table->integer('existencia_lote_unidad')->nullable(); 
            $table->date('caducidad_lote');
            $table->enum('estado_lote',['ACTIVO','DESHABILITADO'])->default('DESHABILITADO');
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
        Schema::dropIfExists('lotes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_compra');
            $table->decimal('total',10,2);
            $table->integer('item');
            $table->string('descripcion_lote',150)->nullable();
            $table->string('factura')->unique();
            $table->foreignId('politicas_garantias_id')->constrained();
            $table->foreignId('users_id')->constrained();
            $table->foreignId('proveedores_id')->constrained();
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
        Schema::dropIfExists('purchases');
    }
}

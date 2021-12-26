<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_cargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cargas_id')->constrained(); 
            $table->foreignId('products_id')->constrained(); 
            $table->string('detalle_cargas_lote',50); 
            $table->date('vencimiento_lote');
            $table->decimal('detalle_cargas_costo',10,4);
            $table->decimal('detalle_cargas_costo_iva',10,4);
            $table->decimal('detalle_cargas_costo_mas_iva',10,4);
            $table->decimal('detalle_cargas_precio_venta',10,4);
            $table->decimal('detalle_cargas_precio_iva',10,4);
            $table->decimal('detalle_cargas_precio_mas_iva',10,4);
            $table->integer('detalle_cargas_quantity');
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
        Schema::dropIfExists('detalle_cargas');
    }
}

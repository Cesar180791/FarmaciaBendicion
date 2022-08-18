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
            $table->foreignId('lotes_id')->constrained(); 
            $table->decimal('detalle_cargas_costo',10,4);
            $table->decimal('detalle_cargas_costo_iva',10,4);
            $table->decimal('detalle_cargas_costo_mas_iva',10,4);
            $table->decimal('detalle_cargas_precio_caja',10,4);
            $table->decimal('detalle_cargas_precio_mayoreo',10,4);
            $table->decimal('detalle_cargas_precio_unidad',10,4)->nullable();
            $table->integer('detalle_cargas_quantity');
            $table->decimal('costo_ref',10,4);
            $table->decimal('costo_iva_ref',10,4);
            $table->decimal('costo_mas_iva_ref',10,4);
            $table->decimal('precio_venta_ref',10,4);
            $table->decimal('precio_venta_mayoreo_ref',10,4);
            $table->decimal('precio_venta_unidad_ref',10,4);
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

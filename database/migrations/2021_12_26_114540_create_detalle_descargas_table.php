<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleDescargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_descargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('descargas_id')->constrained(); 
            $table->foreignId('lotes_id')->constrained(); 
            $table->decimal('detalle_descargas_costo',10,4);
            $table->decimal('detalle_descargas_costo_iva',10,4);
            $table->decimal('detalle_descargas_costo_mas_iva',10,4);
            $table->decimal('detalle_descargas_precio_venta',10,4);
            $table->decimal('detalle_descargas_precio_iva',10,4);
            $table->decimal('detalle_descargas_precio_mas_iva',10,4);
            $table->integer('detalle_descargas_quantity');
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
        Schema::dropIfExists('detalle_descargas');
    }
}

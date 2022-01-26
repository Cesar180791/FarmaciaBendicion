<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lotes_id')->constrained();
            $table->foreignId('sale_id')->constrained();
            $table->enum('tipo_venta',['Normal','Mayoreo','Unidad']);
            $table->decimal('costo',10,4);
            $table->decimal('costo_iva',10,4);
            $table->decimal('costo_mas_iva',10,4);
            $table->decimal('precio_venta',10,4); 
            $table->decimal('iva_precio_venta',10,4); 
            $table->decimal('precio_venta_mas_iva',10,4); 
            $table->integer('quantity');
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
        Schema::dropIfExists('sale_details');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchases_id')->constrained();
            $table->foreignId('lotes_id')->constrained();
            $table->decimal('costo',10,2);
            $table->decimal('costo_iva',10,2);
            $table->decimal('costo_mas_iva',10,2);
            $table->decimal('precio_venta',10,2);
            $table->decimal('precio_venta_mayoreo',10,2);
            $table->decimal('precio_venta_unidad',10,2); 
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
        Schema::dropIfExists('purchase_details');
    }
}

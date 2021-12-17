<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('chemical_component',100);
            $table->string('barCode',25)->nullable();
            $table->string('Numero_registro',25)->unique();
            $table->string('laboratory');
            $table->string('token')->unique();
            $table->decimal('cost',10,2)->default(0);
            $table->decimal('iva_cost',10,2)->default(0);
            $table->decimal('final_cost',10,2)->default(0);
            $table->decimal('price',10,2)->default(0);
            $table->decimal('iva_price',10,2)->default(0);
            $table->decimal('final_price',10,2)->default(0);
            $table->foreignId('sub_category_id')->constrained();
            $table->enum('estado',['ACTIVO','DESHABILITADO'])->default('ACTIVO');
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
        Schema::dropIfExists('products');
    }
}

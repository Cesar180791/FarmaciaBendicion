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
            $table->decimal('cost',10,4)->default(0);
            $table->decimal('iva_cost',10,4)->default(0);
            $table->decimal('final_cost',10,4)->default(0);
            $table->integer('unidades_presentacion')->default(0);
            $table->decimal('precio_caja',10,4)->default(0);
            $table->decimal('precio_mayoreo',10,4)->default(0);
            $table->decimal('precio_unidad',10,4)->nullable();
            $table->foreignId('sub_category_id')->constrained();
            $table->integer('existencia_caja')->default(0);
            $table->integer('existencia_unidad')->default(0);
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('products_id')->constrained();
            $table->string('concepto');
            $table->integer('cantidad_entrada')->nullable();
            $table->decimal('costo_unit_entrada',10,4)->nullable();
            $table->decimal('costo_total_entrada',10,4)->nullable();
            $table->integer('cantidad_salida')->nullable();
            $table->decimal('costo_unit_salida',10,4)->nullable();
            $table->decimal('costo_total_salida',10,4)->nullable();
            $table->integer('cantidad_existencias_ppal');
            $table->integer('cantidad_existencias_unitarias');
            $table->decimal('costo_unit_existencias_ppal',10,4);
            $table->decimal('costo_unit_existencias_unitarias',10,4);
            $table->decimal('costo_total_existencias',10,4);
            $table->integer('id_transaccion');
            $table->enum('tipo_movimiento',['Venta','Compra','Carga','Descarga','Inicio']);
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
        Schema::dropIfExists('kardex_productos');
    }
}

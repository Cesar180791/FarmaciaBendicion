<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Decimal;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('cliente_consumidor_final',150)->nullable();
            $table->string('direccion_consumidor_final',150)->nullable();
            $table->string('dui_consumidor_final',150)->nullable();
            $table->decimal('total',10,2);
            $table->integer('items');
            $table->decimal('cash',10,2);
            $table->decimal('change',10,2);
            $table->string('numero_factura')->nullable();
            $table->enum('status',['PAID','PENDING','CANCELLED'])->default('PAID');
            $table->foreignId('clientes_id')->constrained()->nullable();
            $table->foreignId('tipos_transacciones_id')->constrained();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('sales');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDecimal4DigitosToPurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_details', function (Blueprint $table) {
            $table->decimal('costo',10,4)->change();
            $table->decimal('costo_iva',10,4)->change();
            $table->decimal('costo_mas_iva',10,4)->change();
            $table->decimal('precio_venta',10,4)->change();
            $table->decimal('precio_venta_mayoreo',10,4)->change();
            $table->decimal('precio_venta_unidad',10,4)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_details', function (Blueprint $table) {
            $table->decimal('costo',10,2)->change();
            $table->decimal('costo_iva',10,2)->change();
            $table->decimal('costo_mas_iva',10,2)->change();
            $table->decimal('precio_venta',10,2)->change();
            $table->decimal('precio_venta_mayoreo',10,2)->change();
            $table->decimal('precio_venta_unidad',10,2)->nullable()->change();
        });
    }
}

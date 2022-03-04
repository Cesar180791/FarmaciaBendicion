<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteForeingKeyAndDeleteCeldaPoliticasGarantiasIdToPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            //
            $table->dropForeign('purchases_politicas_garantias_id_foreign');
            $table->dropColumn('politicas_garantias_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreignId('politicas_garantias_id')->constrained();
        });
    }
}

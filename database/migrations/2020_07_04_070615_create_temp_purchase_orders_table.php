<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('temp_po_id');
            $table->string('po_id')->nullable();
            $table->string('po_id_format')->nullable();
            $table->integer('sup_id')->nullable();
            $table->integer('discount')->nullable();
            $table->string('type', 1)->nullable();
            $table->date('date')->nullable();
            $table->string('note')->nullable();
            $table->integer('id_user');
            $table->dateTime('expr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_purchase_orders');
    }
}

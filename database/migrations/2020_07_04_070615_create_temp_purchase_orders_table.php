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
            $table->integer('sup_id');
            $table->integer('discount');
            $table->string('type');
            $table->date('date');
            $table->string('note');
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

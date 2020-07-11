<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempPurchaseOrderCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_purchase_order_customers', function (Blueprint $table) {
            $table->bigIncrements('temp_po_id');
            $table->string('po_id');
            $table->string('po_num');
            $table->string('id_penawaran');
            $table->integer('customer_id');
            $table->string('po_note');
            $table->integer('po_discount');
            $table->string('po_discount_type');
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
        Schema::dropIfExists('temp_purchase_order_customers');
    }
}

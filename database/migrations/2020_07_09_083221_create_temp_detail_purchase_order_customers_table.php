<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempDetailPurchaseOrderCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_detail_purchase_order_customers', function (Blueprint $table) {
            $table->integer('product_id');
            $table->string('product_name');
            $table->integer('qty');
            $table->integer('unit_price');
            $table->integer('temp_po_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_detail_purchase_order_customers');
    }
}

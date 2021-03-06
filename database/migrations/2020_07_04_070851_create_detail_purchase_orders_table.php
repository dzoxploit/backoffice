<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_purchase_orders', function (Blueprint $table) {
            $table->integer('product_id');
            $table->string('product_name');
            $table->integer('qty');
            $table->integer('price');
            $table->integer('discount');
            $table->integer('po_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_purchase_orders');
    }
}

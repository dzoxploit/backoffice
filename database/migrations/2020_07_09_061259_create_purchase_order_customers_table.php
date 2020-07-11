<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Extension\Table\Table;

class CreatePurchaseOrderCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_customers', function (Blueprint $table) {
            $table->string('po_id')->primary();
            $table->string('po_num');
            $table->string('id_penawaran');
            $table->integer('customer_id');
            $table->string('po_note');
            $table->integer('po_discount');
            $table->string('po_discount_type');
            $table->integer('id_user');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order_customers');
    }
}

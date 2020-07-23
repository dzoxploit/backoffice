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
            $table->bigIncrements('po_id');
            $table->string('po_id_format');
            $table->string('po_num');
            $table->string('bargain_id');
            $table->integer('customer_id');
            $table->string('po_note');
            $table->integer('po_discount');
            $table->string('po_discount_type', 1);
            $table->string('po_attachment');
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

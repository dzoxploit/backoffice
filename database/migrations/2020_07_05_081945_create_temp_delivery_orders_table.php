<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempDeliveryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_delivery_orders', function (Blueprint $table) {
            $table->bigIncrements('temp_do_id');
            $table->string('do_id');
            $table->string('do_num');
            $table->string('po_id');
            $table->dateTime('do_date');
            $table->string('do_sender');
            $table->string('do_receiver');
            $table->string('do_deliveryman');
            $table->string('do_note');
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
        Schema::dropIfExists('temp_delivery_orders');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBargainHistoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bargain_history_details', function (Blueprint $table) {
            $table->integer('product_id');
            $table->string('product_name');
            $table->integer('qty');
            $table->integer('unit_price');
            $table->integer('bargain_price');
            $table->string('history_bargain_id');
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
        Schema::dropIfExists('bargain_history_details');
    }
}

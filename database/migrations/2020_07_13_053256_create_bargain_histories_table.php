<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBargainHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bargain_histories', function (Blueprint $table) {
            $table->bigIncrements('history_bargain_id');
            $table->integer('bargain_id');
            $table->string('customer_id');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->date('bargain_expr');
            $table->string('bargain_note');
            $table->date('bargain_closed')->nullable();
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
        Schema::dropIfExists('bargain_histories');
    }
}

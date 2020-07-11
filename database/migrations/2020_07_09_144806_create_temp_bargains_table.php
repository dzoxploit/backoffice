<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempBargainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_bargains', function (Blueprint $table) {
            $table->bigIncrements('temp_bargain_id');
            $table->string('bargain_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->date('bargain_expr')->nullable();
            $table->string('bargain_note')->nul;
            $table->dateTime('temp_expr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_bargains');
    }
}

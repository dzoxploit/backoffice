<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBargainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bargains', function (Blueprint $table) {
            $table->bigIncrements('bargain_id');
            $table->string('bargain_id_format');
            $table->integer('customer_id');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('discount')->nullable();
            $table->string('discount_type', 1)->nullable();
            $table->date('bargain_expr');
            $table->string('bargain_note');
            $table->dateTime('bargain_closed')->nullable();
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
        Schema::dropIfExists('bargains');
    }
}

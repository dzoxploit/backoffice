<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('sup_id');
            $table->string('sup_name');
            $table->string('sup_desc');
            $table->string('sup_address');
            $table->string('sup_address2')->nullable();
            $table->string('sup_cp');
            $table->string('sup_cp2')->nullable();
            $table->string('sup_rek_giro');
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
        Schema::dropIfExists('suppliers');
    }
}

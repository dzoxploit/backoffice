<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoiceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice_histories', function (Blueprint $table) {
            $table->bigIncrements('history_invoice_id');
            $table->string('invoice_id');
            $table->string('po_id');
            $table->date('issue_date');
            $table->date('due_date');
            $table->string('subject');
            $table->string('notes');
            $table->integer('customer_id');
            $table->integer('tax');
            $table->string('payment_method')->nullable();
            $table->dateTime('paid_at')->nullable();
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
        Schema::dropIfExists('sales_invoice_histories');
    }
}

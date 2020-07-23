<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->bigIncrements('invoice_id');
            $table->string('invoice_id_format');
            $table->integer('po_id');
            $table->integer('bill_to');
            $table->string('ship_to');
            $table->string('tax_invoice')->nullable();
            $table->integer('terms');
            $table->date('due_date')->nullable();
            $table->string('ship_via');
            $table->date('ship_date')->nullable();
            $table->string('spell');
            $table->integer('ppn');
            $table->integer('freight');
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('sales_invoices');
    }
}

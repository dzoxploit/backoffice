<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoices')->insert([
            'no_invoice' => '023984/02934',
            'invoice_date' => Carbon::now(),
            'po_id' => '234',
            'confirm_date' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(30),
            'note' => 'Lorem Ipsum Dolor sit amet',
            'id_user' => 1,
        ]);
    }
}

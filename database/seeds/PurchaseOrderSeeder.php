<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_order_customers')->insert([
            'po_id' => '1',
            'sup_id' => 1,
            'discount' => 23,
            'type' => '%',
            'date' => Carbon::now(),
            'note' => 'Lorem Ipsum Dolor sit amet',
            'id_user' => 1,
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseOrderCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_order_customers')->insert([
            'po_id' => '023984/02934',
            'po_num' => '23984791/2349',
            'bargain_id' => '543234sfdg',
            'customer_id' => 1,
            'po_note' => 'Lorem Ipsum Dolor sit amet',
            'po_discount' => 200,
            'po_discount_type' => '%',
            'id_user' => 1
        ]);
    }
}

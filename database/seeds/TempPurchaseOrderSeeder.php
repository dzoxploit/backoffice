<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TempPurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('temp_purchase_orders')->insert([
            'po_id' => '',
            'sup_id' => 1,
            'discount' => 23,
            'type' => '%',
            'date' => Carbon::now(),
            'note' => 'Lorem Ipsum Dolor sit amet',
            'id_user' => 1,
            'expr' => Carbon::now()->addDays(1)
        ]);
    }
}

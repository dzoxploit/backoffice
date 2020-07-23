<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'fullname' => 'Tegar',
            'address' => 'Jl. Mana Ajah',
            'no_telp' => '0891239',
            'company' => 'PT. Mana ajah',
            'department' => 'apaan ajah',
        ]);
    }
}

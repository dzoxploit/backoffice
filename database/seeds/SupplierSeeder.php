<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            'sup_name' => 'CV. Kukuk Jaya',
            'sup_desc' => 'Jual Ayam Negeri dan ayam kampung masih segar mantap',
            'sup_address' => 'Jl. Hj.Muad No.1G',
            'sup_address2' => '',
            'sup_cp' => '0895610355705',
            'sup_cp2' => '089531061407',
            'sup_rek_giro' => '001122334455',
        ]);
    }
}

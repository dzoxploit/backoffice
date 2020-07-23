<?php

use App\Customer;
use App\PurchaseOrderCustomer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        // $this->call(SupplierSeeder::class);
        // $this->call(TempPurchaseOrderSeeder::class);
        // $this->call(InvoiceSeeder::class);
        // $this->call(RoleSeeder::class);
        
        
        // $this->call(CustomerSeeder::class);
        // $this->call(PurchaseOrderCustomerSeeder::class);
    }
}

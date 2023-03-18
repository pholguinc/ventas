<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Sale;
use App\Models\SaleDetail;
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
        $this->call(CategorySeeder::class);
        $this->call(RoleSeeder::class);
        //Brand::factory(30)->create();
        Product::factory(100)->create();
        Provider::factory(30)->create();
        Customer::factory(30)->create();
        //SaleDetail::factory(100)->create();
        //Sale::factory(100)->create();

    }
}

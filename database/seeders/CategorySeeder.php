<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::factory(1)->create()->first();
        $brands = Brand::factory(30)->create();

        foreach ($brands as $brand) {
            $brand->categories()->attach($category->id);
        }
    }
}

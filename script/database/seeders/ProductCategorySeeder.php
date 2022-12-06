<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_categories = array(
            array('id' => '1','user_id' => '3','title' => 'Accessories','created_at' => '2022-08-08 17:08:44','updated_at' => '2022-08-08 17:08:44'),
            array('id' => '2','user_id' => '3','title' => 'Fashion','created_at' => '2022-08-08 17:08:54','updated_at' => '2022-08-08 17:08:54'),
            array('id' => '3','user_id' => '3','title' => 'Mobile','created_at' => '2022-08-08 17:08:59','updated_at' => '2022-08-08 17:08:59'),
            array('id' => '4','user_id' => '3','title' => 'Computer','created_at' => '2022-08-08 17:09:05','updated_at' => '2022-08-08 17:09:05'),
            array('id' => '5','user_id' => '3','title' => 'Laptop','created_at' => '2022-08-08 17:09:10','updated_at' => '2022-08-08 17:09:10')
        );

        ProductCategory::insert($product_categories);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array(
            array('user_id' => '3', 'category_id' => '1', 'name' => 'Apple', 'type' => '1', 'price' => '100', 'created_at' => '2022-08-08 17:08:44','updated_at' => '2022-08-08 17:08:44'),

            array('user_id' => '3', 'category_id' => '2', 'name' => 'Test', 'type' => '1', 'price' => '200', 'created_at' => '2022-08-08 17:08:54','updated_at' => '2022-08-08 17:08:54'),

            array('user_id' => '3', 'category_id' => '3', 'name' => 'Buiscuites', 'type' => '1', 'price' => '300', 'created_at' => '2022-08-08 17:08:59','updated_at' => '2022-08-08 17:08:59'),

            array('user_id' => '3', 'category_id' => '4', 'name' => 'Bat', 'type' => '1', 'price' => '400', 'created_at' => '2022-08-08 17:09:05','updated_at' => '2022-08-08 17:09:05'),

            array('user_id' => '3', 'category_id' => '1', 'name' => 'Demo', 'type' => '1', 'price' => '10', 'created_at' => '2022-08-08 17:09:10','updated_at' => '2022-08-08 17:09:10')
        );

        Product::insert($products);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ProductStorefront;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productStore = array(
            array('storefront_id' => 1, 'product_id' => 1),
            array('storefront_id' => 1, 'product_id' => 2),
            array('storefront_id' => 1, 'product_id' => 3),
            array('storefront_id' => 1, 'product_id' => 4),
            array('storefront_id' => 1, 'product_id' => 5),
        );

        ProductStorefront::insert($productStore);
    }
}

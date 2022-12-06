<?php

namespace Database\Seeders;

use App\Models\Storefront;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreFrontSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storefronts = array(
            array('id' => '1','user_id' => '3','name' => 'Digital Mart','description' => 'Digital mart description Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Pellentesque in ipsum id orci porta dapibus. Sed porttitor lectus nibh. Cras ultricies ligula sed magna dictum porta. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.','product_type' => '1','shipping_status' => '1','note_status' => '0','created_at' => '2022-08-08 17:11:27','updated_at' => '2022-08-08 17:11:27')
        );

        Storefront::insert($storefronts);
    }
}

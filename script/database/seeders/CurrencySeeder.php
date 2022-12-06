<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            ['id' => '1','name' => 'US Dollar','country_name' => 'United State','code' => 'USD','rate' => '1','symbol' => '$','position' => 'left','status' => '1','is_default' => '1','created_at' => '2022-08-07 19:04:59','updated_at' => '2022-08-07 19:04:59'],
            ['id' => '2','name' => 'Euro','country_name' => 'Euro','code' => 'EUR','rate' => '0.98','symbol' => '€','position' => 'left','status' => '1','is_default' => '0','created_at' => '2022-08-07 19:04:59','updated_at' => '2022-08-07 19:05:38'],
            ['id' => '4','name' => 'Indian Rupee','country_name' => 'India','code' => 'INR','rate' => '79.37','symbol' => '₹','position' => 'left','status' => '1','is_default' => '0','created_at' => '2022-08-07 19:04:59','updated_at' => '2022-08-07 19:05:38'],
            ['id' => '5','name' => 'Nigerian Naira','country_name' => 'Nigeria','code' => 'NGN','rate' => '417.57','symbol' => '₦','position' => 'left','status' => '1','is_default' => '0','created_at' => '2022-08-07 19:04:59','updated_at' => '2022-08-07 19:05:38'],
            ['id' => '6','name' => 'Malaysian Ringgit','country_name' => 'Malaysia','code' => 'MYR','rate' => '4.46','symbol' => 'RM','position' => 'left','status' => '1','is_default' => '0','created_at' => '2022-08-07 19:04:59','updated_at' => '2022-08-07 19:05:38'],
            ['id' => '7','name' => 'Omani rial','country_name' => 'Saudi Arab','code' => 'OMR','rate' => '0.39','symbol' => 'ر.ع.','position' => 'right','status' => '1','is_default' => '0','created_at' => '2022-08-07 19:04:59','updated_at' => '2022-08-07 19:04:59']
        ];

        Currency::insert($currencies);
    }
}

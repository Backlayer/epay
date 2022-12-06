<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = array(
            array('id' => '1','name' => 'Header','position' => 'header','data' => '[{"text":"Home","href":"/","icon":"","target":"_self","title":""},{"text":"About Us","href":"/about","icon":"empty","target":"_self","title":""},{"text":"Blog","href":"/blog","icon":"empty","target":"_self","title":""},{"text":"Contact","href":"/contact","icon":"empty","target":"_self","title":""}]','lang' => 'en','status' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','name' => 'Our Solutions','position' => 'footer_left_menu','data' => '[{"text":"Transfer Money","icon":"","href":"#","target":"_self","title":""},{"text":"Request Money","icon":"empty","href":"#","target":"_self","title":""},{"text":"Virtual Cards","icon":"empty","href":"#","target":"_self","title":""},{"text":"Bill Payments","icon":"empty","href":"#","target":"_self","title":""}]','lang' => 'en','status' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','name' => 'HELP','position' => 'footer_right_menu','data' => '[{"text":"Contact","icon":"","href":"/contact","target":"_self","title":""},{"text":"FAQs","icon":"empty","href":"#","target":"_self","title":""},{"text":"Terms or Service","icon":"empty","href":"#","target":"_self","title":""},{"text":"Privacy Policy","icon":"empty","href":"#","target":"_self","title":""}]','lang' => 'en','status' => '1','created_at' => NULL,'updated_at' => NULL)
        );
        Menu::insert($menus);
    }
}

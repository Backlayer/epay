<?php

namespace Database\Seeders;

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
        $categories = array(
            array('id' => '14','key' => 'faq','value' => '{"answer": "Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt eiusmod.", "question": "What is the regular license?"}','lang' => 'en','status' => '1','created_at' => '2022-07-31 14:39:28','updated_at' => '2022-07-31 14:50:48'),
            array('id' => '15','key' => 'faq','value' => '{"answer": "Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt eiusmod.", "question": "How can I purchased The Sell?"}','lang' => 'en','status' => '1','created_at' => '2022-07-31 14:39:29','updated_at' => '2022-07-31 14:51:06'),
            array('id' => '16','key' => 'faq','value' => '{"answer": "Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt eiusmod.", "question": "What are the minimum requirements?"}','lang' => 'en','status' => '1','created_at' => '2022-07-31 14:39:31','updated_at' => '2022-07-31 14:51:21'),
            array('id' => '17','key' => 'reviews','value' => '{"name": "Ajoy Das", "image": "/uploads/1/22/07/62e68167244e53107221659273575.jpg", "rating": "5", "comment": "Veritatis fugit quam blanditiis rerum reprehenderit maxime expedita odit,\\r\\n                                laboriosam voluptatibus? Iure corporis nulla eveniet quam.", "position": "CEO"}','lang' => 'en','status' => '1','created_at' => '2022-07-31 14:47:55','updated_at' => '2022-07-31 14:47:55'),
            array('id' => '18','key' => 'reviews','value' => '{"name": "Chaity Shaha", "image": "/uploads/1/22/07/62e681674414c3107221659273575.jpg", "rating": "4", "comment": "Veritatis fugit quam blanditiis rerum reprehenderit maxime expedita edit,  laboriosam voluptatibus? Iure corporis nulla eveniet quam.", "position": "CEO"}','lang' => 'en','status' => '1','created_at' => '2022-07-31 14:48:35','updated_at' => '2022-07-31 14:48:35'),
            array('id' => '19','key' => 'reviews','value' => '{"name": "Chaity Shaha", "image": "/uploads/1/22/07/62e681674414c3107221659273575.jpg", "rating": "4", "comment": "Veritatis fugit quam blanditiis rerum reprehenderit maxime expedita edit,  laboriosam voluptatibus? Iure corporis nulla eveniet quam.", "position": "Developer"}','lang' => 'en','status' => '1','created_at' => '2022-07-31 14:48:35','updated_at' => '2022-07-31 14:48:35'),
            array('id' => '20','key' => 'reviews','value' => '{"name": "Ajoy Das", "image": "/uploads/1/22/07/62e68167244e53107221659273575.jpg", "rating": "5", "comment": "Veritatis fugit quam blanditiis rerum reprehenderit maxime expedita odit,\\r\\n                                laboriosam voluptatibus? Iure corporis nulla eveniet quam.", "position": "Developer"}','lang' => 'en','status' => '1','created_at' => '2022-07-31 14:47:55','updated_at' => '2022-07-31 14:47:55')
        );

        Category::insert($categories);
    }
}

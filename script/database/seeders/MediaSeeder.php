<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $media = [
            ['id' => '1','url' => '/uploads/1/22/07/62e6814c04fd93107221659273548.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6814c04fd93107221659273548.png","/uploads\\/1\\/22\\/07\\/62e6814c04fd93107221659273548small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '2','url' => '/uploads/1/22/07/62e6814c3a57a3107221659273548.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6814c3a57a3107221659273548.png","/uploads\\/1\\/22\\/07\\/62e6814c3a57a3107221659273548small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '3','url' => '/uploads/1/22/07/62e6814c6a87d3107221659273548.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6814c6a87d3107221659273548.png","/uploads\\/1\\/22\\/07\\/62e6814c6a87d3107221659273548small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '4','url' => '/uploads/1/22/07/62e6814c8ed5f3107221659273548.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6814c8ed5f3107221659273548.png","/uploads\\/1\\/22\\/07\\/62e6814c8ed5f3107221659273548small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '5','url' => '/uploads/1/22/07/62e6814cae0483107221659273548.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6814cae0483107221659273548.png","/uploads\\/1\\/22\\/07\\/62e6814cae0483107221659273548small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '6','url' => '/uploads/1/22/07/62e6814cd37233107221659273548.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6814cd37233107221659273548.png","/uploads\\/1\\/22\\/07\\/62e6814cd37233107221659273548small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '7','url' => '/uploads/1/22/07/62e681584c3fa3107221659273560.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e681584c3fa3107221659273560.png","/uploads\\/1\\/22\\/07\\/62e681584c3fa3107221659273560small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '8','url' => '/uploads/1/22/07/62e681586a77e3107221659273560.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e681586a77e3107221659273560.png","/uploads\\/1\\/22\\/07\\/62e681586a77e3107221659273560small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '9','url' => '/uploads/1/22/07/62e68164ae22d3107221659273572.jpg','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e68164ae22d3107221659273572.jpg","/uploads\\/1\\/22\\/07\\/62e68164ae22d3107221659273572small.jpg"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '10','url' => '/uploads/1/22/07/62e6816541fb23107221659273573.jpg','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6816541fb23107221659273573.jpg","/uploads\\/1\\/22\\/07\\/62e6816541fb23107221659273573small.jpg"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '11','url' => '/uploads/1/22/07/62e68165722793107221659273573.jpg','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e68165722793107221659273573.jpg","/uploads\\/1\\/22\\/07\\/62e68165722793107221659273573small.jpg"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '12','url' => '/uploads/1/22/07/62e681659c5b43107221659273573.jpg','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e681659c5b43107221659273573.jpg","/uploads\\/1\\/22\\/07\\/62e681659c5b43107221659273573small.jpg"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '13','url' => '/uploads/1/22/07/62e68165d30713107221659273573.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e68165d30713107221659273573.png","/uploads\\/1\\/22\\/07\\/62e68165d30713107221659273573small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '14','url' => '/uploads/1/22/07/62e681666b4b43107221659273574.jpg','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e681666b4b43107221659273574.jpg","/uploads\\/1\\/22\\/07\\/62e681666b4b43107221659273574small.jpg"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '15','url' => '/uploads/1/22/07/62e681669aeac3107221659273574.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e681669aeac3107221659273574.png","/uploads\\/1\\/22\\/07\\/62e681669aeac3107221659273574small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '16','url' => '/uploads/1/22/07/62e68166c3d283107221659273574.jpg','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e68166c3d283107221659273574.jpg","/uploads\\/1\\/22\\/07\\/62e68166c3d283107221659273574small.jpg"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '17','url' => '/uploads/1/22/07/62e68166eb7623107221659273574.jpg','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e68166eb7623107221659273574.jpg","/uploads\\/1\\/22\\/07\\/62e68166eb7623107221659273574small.jpg"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '18','url' => '/uploads/1/22/07/62e68167244e53107221659273575.jpg','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e68167244e53107221659273575.jpg","/uploads\\/1\\/22\\/07\\/62e68167244e53107221659273575small.jpg"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '19','url' => '/uploads/1/22/07/62e681674414c3107221659273575.jpg','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e681674414c3107221659273575.jpg","/uploads\\/1\\/22\\/07\\/62e681674414c3107221659273575small.jpg"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '20','url' => '/uploads/1/22/07/62e68167656593107221659273575.jpg','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e68167656593107221659273575.jpg","/uploads\\/1\\/22\\/07\\/62e68167656593107221659273575small.jpg"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '21','url' => '/uploads/1/22/07/62e6816794fde3107221659273575.jpg','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6816794fde3107221659273575.jpg","/uploads\\/1\\/22\\/07\\/62e6816794fde3107221659273575small.jpg"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '22','url' => '/uploads/1/22/07/62e6849c3e2853107221659274396.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6849c3e2853107221659274396.png","/uploads\\/1\\/22\\/07\\/62e6849c3e2853107221659274396small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '23','url' => '/uploads/1/22/07/62e68862ac24c3107221659275362.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e68862ac24c3107221659275362.png","/uploads\\/1\\/22\\/07\\/62e68862ac24c3107221659275362small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '24','url' => '/uploads/1/22/07/62e69773699843107221659279219.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e69773699843107221659279219.png","/uploads\\/1\\/22\\/07\\/62e69773699843107221659279219small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
        ];

        Media::insert($media);
    }
}

<?php

namespace Database\Seeders;

use App\Models\KycMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KycSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kyc = [
            [
                'title' => 'ID Card',
                'image' => "/uploads/id-card.png",
                'image_accept' => 1,
                'status' => 1,
                'fields' => '[{"type": "text", "label": "ID No"}, {"type": "file", "label": "Image"}, {"type": "text", "label": "Date Of Birth"}]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Driving License',
                'image' => "/uploads/id-card.png",
                'image_accept' => 1,
                'status' => 1,
                'fields' => '[{"type": "text", "label": "ID No"}, {"type": "file", "label": "Image"}]',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        KycMethod::insert($kyc);
    }
}

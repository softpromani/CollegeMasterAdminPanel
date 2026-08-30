<?php

namespace CollegeAdmin\Database\Seeders;

use CollegeAdmin\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title_1' => 'Welcome to Library Science',
                'title_2' => 'Knowledge • Learning • Growth',
                'url' => '/about',
                'image' => null,
            ],
            [
                'title_1' => 'Modern Education & Research',
                'title_2' => 'Research • Innovation • Excellence',
                'url' => '/admission',
                'image' => null,
            ],
            [
                'title_1' => 'Empowering Future Leaders',
                'title_2' => 'Comprehensive Learning & Digital Archives',
                'url' => '/courses',
                'image' => null,
            ],
        ];

        foreach ($banners as $data) {
            Banner::firstOrCreate(
                ['title_1' => $data['title_1']],
                $data
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carousels = [
            [
                'image' => 'images/carousel/banner1.jpg',
                'order' => 1,
                'status' => true,
            ],
            [
                'image' => 'images/carousel/banner2.jpg',
                'order' => 2,
                'status' => true,
            ],
            [
                'image' => 'images/carousel/banner3.jpg',
                'order' => 3,
                'status' => true,
            ],
        ];

        foreach ($carousels as $carousel) {
            Carousel::create($carousel);
        }
    }
}

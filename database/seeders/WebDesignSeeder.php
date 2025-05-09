<?php

namespace Database\Seeders;

use App\Models\WebDesign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebDesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebDesign::create([
            'service_order' => 1,
            'service_status' => true,
            'carousel_order' => 1,
            'carousel_status' => true,
        ]);
    }
}

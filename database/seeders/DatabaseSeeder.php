<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // 1. First basic user and system configuration
            UserSeeder::class,
            SettingSeeder::class,
            WebDesignSeeder::class,
            
            // 2. Basic content and business details
            ServiceSeeder::class,
            CarouselSeeder::class,
            CustomerSeeder::class,
            PartnerSeeder::class,
            DeliveryRouteSeeder::class,
            
            // 3. Categories before their related content
            ProductCategorySeeder::class,
            PostCategorySeeder::class,
            
            // 4. Content that depends on categories
            ProductSeeder::class,
            PostSeeder::class,
        ]);
    }
}

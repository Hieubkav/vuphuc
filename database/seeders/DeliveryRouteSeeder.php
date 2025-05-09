<?php

namespace Database\Seeders;

use App\Models\DeliveryRoute;
use Illuminate\Database\Seeder;

class DeliveryRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deliveryRoutes = [
            [
                'name' => 'Tuyến Cần Thơ - Sóc Trăng',
                'description' => 'Tuyến giao hàng từ Cần Thơ đến Sóc Trăng, thời gian 1-2 ngày',
                'order' => 1,
                'status' => true,
            ],
            [
                'name' => 'Tuyến Cần Thơ - Kiên Giang',
                'description' => 'Tuyến giao hàng từ Cần Thơ đến Kiên Giang, thời gian 1-2 ngày',
                'order' => 2,
                'status' => true,
            ],
            [
                'name' => 'Tuyến Cần Thơ - Cà Mau',
                'description' => 'Tuyến giao hàng từ Cần Thơ đến Cà Mau, thời gian 1-3 ngày',
                'order' => 3,
                'status' => true,
            ],
            [
                'name' => 'Tuyến Cần Thơ - An Giang',
                'description' => 'Tuyến giao hàng từ Cần Thơ đến An Giang, thời gian 1-2 ngày',
                'order' => 4,
                'status' => true,
            ],
        ];

        foreach ($deliveryRoutes as $deliveryRoute) {
            DeliveryRoute::create($deliveryRoute);
        }
    }
}

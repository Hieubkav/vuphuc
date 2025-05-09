<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'email' => 'customer1@example.com',
                'phone' => '0901234567',
                'password' => Hash::make('password'),
                'name' => 'Khách hàng 1',
                'address' => 'Cần Thơ',
                'order' => 1,
                'status' => true,
            ],
            [
                'email' => 'customer2@example.com',
                'phone' => '0909876543',
                'password' => Hash::make('password'),
                'name' => 'Khách hàng 2',
                'address' => 'Sóc Trăng',
                'order' => 2,
                'status' => true,
            ],
            [
                'email' => 'customer3@example.com',
                'phone' => '0908765432',
                'password' => Hash::make('password'),
                'name' => 'Khách hàng 3',
                'address' => 'Kiên Giang',
                'order' => 3,
                'status' => true,
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}

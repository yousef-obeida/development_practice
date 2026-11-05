<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'Staff User',
            'email' => 'customer@example.com',
            'phone_number' => '1234567890',
            'address' => '123 Main St',
            'city' => 'Anytown',
            'password' => Hash::make('password'),
        ]);
    }
}

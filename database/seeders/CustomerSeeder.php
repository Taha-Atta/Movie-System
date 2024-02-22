<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $imagePath = 'public/customers/images';
        $imageFilename = $faker->image($imagePath, 400, 300, 'people', false);
        // Customer::create([
        //     'image'=> $imageFilename,
        //     'join_year'=>2021,
        //     'user_id'=>1,
        // ]);
        // Customer::create([
        //     'image'=> $imageFilename,
        //     'join_year'=>2022,
        //     'user_id'=>2,
        // ]);
        Customer::create([
            'image'=> $imageFilename,
            'join_year'=>2023,
            'user_id'=>3,
        ]);
        // foreach (range(1, 5) as $index) {

        //     DB::table('customers')->insert([
        //         'image' => $imageFilename,
        //         'join_year' => 2023,
        //         'user_id' => 3,
        //     ]);
        // }
    }
}

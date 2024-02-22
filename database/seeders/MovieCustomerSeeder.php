<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer_id =1;
        $movies = Movie::all();

        $customer = Customer::find(1);

        $customer->movies()->attach($movies);
    }
}

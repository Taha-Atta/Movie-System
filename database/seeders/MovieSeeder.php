<?php

namespace Database\Seeders;

use App\Models\Movie;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $MediaPath = 'public/Movies/Media';
        $imageFilename = $faker->image($MediaPath, 400, 300, 'people', false);
        $videoFilename = $faker->image($MediaPath, 400, 300, 'people', false);
        Movie::create([
            'title'=> 'titance',
            'summery'=>'romantic filme',
            'video'=> $videoFilename,
            'image'=>$imageFilename,
            'duration'=>3,
            'lanchYear'=>2000,
            'isFree'=>1
        ]);
    }
}

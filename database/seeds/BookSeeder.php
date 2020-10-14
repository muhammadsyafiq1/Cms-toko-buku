<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [];
        $faker = Faker\Factory::create();
        $image_categories = ["abstract","animals","business","cats","city","food","nature","technics","transport"];

        for($i = 0; $i < 4; $i++){
            $title = $faker->sentence(mt_rand(3,6));
            $title = str_replace('-','',$title);
            $slug = str_replace('','-', strtolower($title));
            $category = $image_categories[mt_rand(0, 8)];
            $cover_path = 'C:\Users\syafiq\my portfolio\larashop\public\storage\covers';
            $cover_fullpath = $faker->image($cover_path, 300, 500 ,$category, true, true, $category);
            $cover = str_replace($cover_path . '/' , '' , $cover_fullpath);

            $books[$i] = [
                'title' => $title,
                'slug' => $slug,
                'stock' => 10,
                'description' => $faker->text(255),
                'author' => $faker->name,
                'publisher' => $faker->company,
                'cover' => $cover,
                'price' => mt_rand(1, 10) * 5000,
                'weight' => 0.5,
                'status' => 'publisher',
                'created_at' => Carbon::now(),
            ];
        }
        DB::table('books')->insert($books);
    }
}

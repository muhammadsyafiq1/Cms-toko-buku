<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $faker = Faker\Factory::create();
        $images_categories = ["abstract","animals","business","cats","city","food","nature","technics","transport"];

        for($i = 0; $i < 16; $i++) {
            $name = $faker->unique()->word();
            $name = str_replace('.', '', $name);
            $slug = str_replace('','-', strtolower($name));
            $category = $images_categories[mt_rand(0, 8)];
            $image_path = 'C:\Users\syafiq\my portfolio\larashop\public\storage\images';
            $image_fullpath = $faker->image($image_path, 300, 500 ,$category, true, true, $category);
            $image = str_replace($image_path . '/' , '' , $image_fullpath);

            $categories[$i] = [
                'name' => $name,
                'slug' => $slug,
                'image' => $image,
                'status' => 'publish',
                'created_at' => Carbon::now(),
            ];

        }
        DB::table('categories')->insert($categories);
    }
}

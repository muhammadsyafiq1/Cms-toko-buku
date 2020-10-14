<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];
        $faker = Faker\Factory::create();

        for($i = 0 ; $i < 5; $i++){
            $avatar_path = 'C:\Users\syafiq\my portfolio\larashop\public\storage\avatars';
            $avatar_fullpath = $faker->image($avatar_path, 200, 250, "people", true ,true, "people");

            $avatar = str_replace($avatar_path . '/' , '' ,$avatar_fullpath);
            $users[$i] = [
                'name' => $faker->name,
                'username' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('1234567890'),
                'roles' => json_encode(['customer']),
                'avatar' => $avatar,
                'status' => 'active',
                'created_at' => Carbon::now(),
            ];
        }
        DB::table('users')->insert($users);
    }
}

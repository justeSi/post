<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Manager;
use App\Models\Animal;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('lt_LT');



        DB::table('users')->insert([
            'name' => 'Juste',
            'email' => 'juste@gmail.com',
            'password' => Hash::make('123'),
        ]);

        foreach (range(0, 10) as  $_ ) {
            
            DB::table('posts')->insert([
                'town' => $faker->city(),
                'capacity' => 20,
                'code' =>'P-'.rand(1,99),
            ]);
        }

        foreach (range(1, 50) as  $_ ) {
            DB::table('parcels')->insert([
                'weight' => mt_rand(111, 15999)/100,
                'phone' => '+37069'.rand(100000, 999999),
                'info' => $faker->text(400),
                'post_id' => rand(1, 11)
            ]);
        }


    }
}
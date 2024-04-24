<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 45) as $index) {
            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->unique()->email;
            $user->phone = $this->generatePhoneNumber();
            $user->position_id = rand(1,5);
            $user->photo = $faker->imageUrl(200, 200, 'people');
            $user->save();
        }
    }

    private function generatePhoneNumber(): int
    {
        return '+380' . mt_rand(100000000, 999999999);
    }
}

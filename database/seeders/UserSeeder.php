<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "first_name" => "Kevin",
            "last_name" => "Kamtchoum",
            "phone" => "678799623",
            "email" => "kkmmarino@gmail.com",
            "password" => Hash::make("12344678"),
            "points" => 7500,
            "city_id" => rand(1, 5),
        ])->assignRole("super_admin");

        User::create([
            "first_name" => "Yves",
            "last_name" => "Loic",
            "phone" => "693624491",
            "email" => "loic@example.org",
            "password" => Hash::make("yves1234*"),
            "points" => 7500,
            "city_id" => rand(1, 5),
        ])->assignRole("super_admin");

        User::create([
            "first_name" => "Nana",
            "last_name" => "Derick",
            "phone" => "655316013",
            "email" => "adnedesign@gmail.com",
            "password" => Hash::make("655316013"),
            "points" => 7500,
            "city_id" => rand(1, 5),
        ])->assignRole("client");

        User::create([
            "first_name" => "Derick",
            "last_name" => "Yeager Eren",
            "phone" => "681619855",
            "email" => "dericknana237@gmail.com",
            "password" => Hash::make("681619855"),
            "points" => 7500,
            "city_id" => rand(1, 5),
        ])->assignRole("driver");

        User::factory()
            ->afterCreating(function ($user) {
                $user->assignRole(Role::findById(rand(1, 3)));
            })
            ->count(48)
            ->create();
    }
}

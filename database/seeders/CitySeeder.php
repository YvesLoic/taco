<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'name' => 'Yaoundé',
            'country_id' => 1,
        ]);
        City::create([
            'name' => 'Douala',
            'country_id' => 1,
        ]);
        City::factory()->count(3)->create();
    }
}

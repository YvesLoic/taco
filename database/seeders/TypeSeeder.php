<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'amount' => 2500,
            'label' => 'VIP 1',
        ]);
        Type::create([
            'amount' => 5000,
            'label' => 'VIP 2',
        ]);
    }
}

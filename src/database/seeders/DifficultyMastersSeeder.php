<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DifficultyMaster;

class DifficultyMastersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $difficulties = [
            ['高', 100, 3],
            ['中', 50, 2],
            ['低', 10, 1],
        ];

        foreach ($difficulties as $difficulty) {
            DifficultyMaster::create([
                'difficulty' => $difficulty[0],
                'exp' => $difficulty[1],
                'star_num' => $difficulty[2]
            ]);
        }
    }
}

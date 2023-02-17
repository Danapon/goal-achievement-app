<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LevelMaster;

class LevelMastersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            [1, 0, 'images/lv1-hero.png'],
            [2, 50, 'images/lv2-hero.png'],
            [3, 100, 'images/lv3-hero.png'],
            [4, 150, 'images/lv4-hero.png'],
            [5, 200, 'images/lv5-hero.png'],
            [6, 300, 'images/lv6-hero.png'],
            [7, 400, 'images/lv7-hero.png'],
            [8, 550, 'images/lv8-hero.png'],
            [9, 700, 'images/lv9-hero.png'],
            [10, 850, 'images/lv10-hero.png'],
        ];

        foreach ($levels as $level) {
            LevelMaster::create([
                'level' => $level[0],
                'required_exp' => $level[1],
                'avator_url' => $level[2]
            ]);
        }
    }
}

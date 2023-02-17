<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\LevelMaster;
use Database\Seeders\LevelMastersSeeder;
use Database\Seeders\TestingDatabaseSeeder;

class LevelMasterTest extends TestCase
{

    // 都度テスト用テーブルのデータを削除
    use RefreshDatabase;

    public function dataProvider_for_LevelMaster(): array
    {
        return [
            [1,0],
            [1,1],
            [1,49],
            [2,50],
            [2,51],
            [2,99],
            [3,100],
            [3,101],
            [3,149],
            [4,150],
            [4,151],
            [4,199],
            [5,200],
            [5,201],
            [5,299],
            [6,300],
            [6,301],
            [6,399],
            [7,400],
            [7,401],
            [7,549],
            [8,550],
            [8,551],
            [8,699],
            [9,700],
            [9,701],
            [9,849],
            [10,850],
            [10,851]
        ];
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @dataProvider dataProvider_for_LevelMaster
     * @test
     */
    public function getLevelMaster_レコード取得(int $expected, int $required_exp)
    {
        // シーダを実行
        $this->seed(LevelMastersSeeder::class);

        // 指定のレベルのレコードが取得されていることを確認
        $level_masters = new LevelMaster();
        $result = $level_masters->getLevelMaster($required_exp);
        $this->assertSame($result->level, $expected);

    }
}

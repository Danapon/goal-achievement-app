<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\LevelMaster;
use App\Services\LevelService;
use Database\Seeders\LevelMastersSeeder;

class LevelServiceTest extends TestCase
{

    // 都度テスト用テーブルのデータを削除
    use RefreshDatabase;

    public function dataProvider_for_LevelService(): array
    {
        // [level値, total_exp値, required_exp_max期待値, current_exp期待値, next_exp期待値]
        return [
            [1, 0, 50, 0, 50],
            [1, 30, 50, 0.6, 20],
            [5, 240, 100, 0.4, 60],
            [10, 850, null, 1, null],
            [10, 1000, null, 1, null]
        ];
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @dataProvider dataProvider_for_LevelService
     * @test
     */
    public function getExpArray_レベル計算(
        int $level, 
        int $total_exp, 
        int $required_exp_max = null, 
        float $current_exp,
        int $next_exp = null)
    {
        // シーダを実行
        $this->seed(LevelMastersSeeder::class);

        // メソッド実行
        $level_service = new LevelService();
        $result = $level_service->getExpArray(LevelMaster::where('level', $level)->first(), $total_exp);

        // テスト結果
        $this->assertSame($result['required_exp_max'], $required_exp_max);
        $this->assertEquals($result['current_exp'], $current_exp);
        $this->assertSame($result['next_exp'], $next_exp);

    }
}

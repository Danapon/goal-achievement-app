<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Services\TotalExpService;
use App\User;
// use Illuminate\Support\Facades\Auth;
use Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

class TotalExpServiceTest extends TestCase
{

    // 都度テスト用テーブルのデータを削除
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */
    public function getTotalExp_経験値を取得()
    {

        $user = \App\Models\User::factory(User::class)->create([
            'password'  => bcrypt('laraveltest123')
            //パスワードは好きな言葉で大丈夫です
        ]);

        // 認証されないことを確認
        // $this->assertFalse(Auth::check());

        // ログインを実行
        $response = $this->post('login', [
            'email'    => $user->email,
            'password' => 'laraveltest123'
            //先ほど設定したパスワードを入力
        ]);

        // 認証されていることを確認
        // $this->assertTrue(Auth::check());

        // ログイン後にホームページにリダイレクトされるのを確認
        // $response->assertRedirect('/home');

        // 指定したキーが存在すること
        // $this->assertDatabaseHas('users', [
        //     'total_exp' => 10,
        // ]);

        // getTotalExpメソッド実行 total_expカラムの値を一致すること
        $total_exp_service = new TotalExpService();
        $result = $total_exp_service->getTotalExp();
        $this->assertSame(10, $result);

    }
}

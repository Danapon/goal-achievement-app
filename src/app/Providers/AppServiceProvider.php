<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// goalsテーブルから値を取得するために必要
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Consts\GoalConsts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* header.blade.phpで$goal_statusを使用するための共通処理 */
        $goal_status = GoalConsts::GOAL_STATUS_TODO; // 0:未達成
        view()->share('goal_status', $goal_status);
    }
}

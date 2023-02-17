<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\SubGoal;

class TotalExpService
{
   /* 累計経験値を取得する処理① */
   public function getTotalExp():int
   {
      // 認証されたユーザーの累計経験値を取得
      return Auth::user()->total_exp;
   }

   /* usersテーブルのtotal_expをリセットする処理⑦ */
   public function resetTotalExp()
   {
      /* usersテーブルのtotal_expをリセットする処理⑦ */
      $users = Auth::user();
      // オブジェクトがnullの場合は404エラーとする
      if (!$users) {
          abort(404);
      }
      $users->total_exp = 0;
      $users->update();
   }

   /* 取得経験値をusersテーブルのtotal_expに加算する処理⑩ */
   public function incrementTotalExp(int $id):int
   {
      // subgoalsテーブルに紐付いた経験値を取得
      $exp = SubGoal::where('id', $id)->with('difficultymaster:id,exp')->first();
      $get_exp = $exp->difficultymaster->exp;
      // get_expをusersテーブルのtotal_expに加算
      Auth::user()->increment('total_exp', $get_exp);
      return $get_exp;
   }    
}
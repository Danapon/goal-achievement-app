<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\LevelMaster;

class Level
{
   /* 現在のレベルのレコードをlevel_mastersテーブルから取得する処理②-1 */
   public function getLevelMaster(int $total_exp):LevelMaster
   {
      // 値に応じたレベルのレコードをlevel_mastersテーブルから取得する
      $level_master = LevelMaster::where('required_exp', '<=', $total_exp)->orderBy('id', 'desc')->first();
      return $level_master;
   }

   /* レベルアップゲージに表示させる値を計算して取得する処理②-2 */
   public function getExpArray(LevelMaster $level_master, int $total_exp):array
   {
      // レベルアップに必要な経験値を取得する(次のrequired_exp - 現在のrequired_exp)
      // レベルがMAXでなければゲージに必要な値を取得
      $exp_array = array();

      if($level_master->next()) {
      
      // 現在の必要な経験値
      $current_required_exp = $level_master->required_exp;
      // 次に必要な経験値
      $next_required_exp = $level_master->next()->required_exp;
      
      // レベルアップに必要な経験値
      $required_exp_max = $next_required_exp - $current_required_exp;
      // レベルアップゲージの比率を計算
      $current_exp = ($total_exp - $current_required_exp) / $required_exp_max;
      // レベルアップまで必要な経験値
      $next_exp = $required_exp_max - ($total_exp - $current_required_exp);
     }
     else {
         // レベルMAXのときレベルアップゲージをMAXにする
         $current_exp = 1;
         // compact関数でエラーが出ないように変数にnullを入れておく
         $required_exp_max = null;
         $next_exp = null;
     }
      // 配列に格納
      $exp_array = array(
      'required_exp_max' => $required_exp_max,
      'current_exp' => $current_exp,
      'next_exp' => $next_exp
      );
     return $exp_array;
   }
}
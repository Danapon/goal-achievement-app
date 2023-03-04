<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\LevelMaster;
use App\ViewContents\ExpViewContent;

class LevelService
{
   /* レベルアップゲージに表示させる値を計算して取得する処理②-2 */
   public function getExp(LevelMaster $level_master, int $total_exp):ExpViewContent
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
         $required_exp_max = 0;
         $next_exp = 0;
     }

    return new ExpViewContent($required_exp_max, $current_exp, $next_exp);

   }
}
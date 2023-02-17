<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\SubGoal;
// use App\Http\Controllers\SubGoalController;
use App\Consts\SubGoalConsts;

class SubGoalService
{
  /* サブ目標設定数を制御する処理⑧ */
  public function countSubGoals(int $goal_id):array
  {
      // subgoals.createに遷移するたびにsubgoalをカウントアップする
      $subgoal_max = SubGoalConsts::SUBGOAL_TODO_CNT - 1;
      $subgoal = SubGoal::where('goal_id', $goal_id)->count();//前画面で設定したgoal_idのレコード数
      $subgoal_array = array();
      // サブ目標設定が最大数に達したかどうかで分岐
      if ($subgoal === $subgoal_max) {
          $isSubgoalMax = true;
          ++$subgoal;
      }
      else {
          $isSubgoalMax = false;
          ++$subgoal;
      }
      // 配列に格納
      $subgoal_array = array(
          'subgoal' => $subgoal,
          'isSubgoalMax' => $isSubgoalMax
        );
      return $subgoal_array;
  }
}
<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoalController;

class Goal
{
   public function getGoals():User
   {
      // Usersテーブルからリレーション設定されたテーブルを全て取得
      $goals = User::where('id', Auth::id())->with('goals.subgoals.difficultymaster')->first();

      return $goals;
   }

   public function getGoalsStatus():array
   {

      // goalsレコードが存在するか判定 存在しない場合はtrueを返す
      $goal_check = $this->getGoals()->goals->isEmpty();

      // goalsレコードが存在する場合は、statusカラムの値をチェックする
      $goal_array = array();

      if (!$goal_check) {
        // usersテーブルに紐付いた全てのgoalsレコードを取得
        $goal_all = $this->getGoals()->goals->all();
        // goalsテーブルからstatusカラムを取得(end()関数で最新のgoalsレコードから取得)
        // 変数を使わないと$goalsに代入する際にエラーとなる（参照渡しが禁止されている）
        $goals = end($goal_all);
        $goal_status = $goals->status;
      }
      else {
        // 以下はcompact関数でエラーにならないための対応
        $goals = [];//goalsレコードが存在しない場合は、空の配列を定義しておく
        $goal_status = GoalController::GOAL_STATUS_TODO;//goalsレコードが存在しない場合は、statusは0:未達成を入れておく
      }
      // 配列に格納
      $goal_array = array(
        'goals' => $goals,
        'goal_check' => $goal_check,
        'goal_status' => $goal_status
      );
      return $goal_array;

   }


}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// 追加
use App\Http\Controllers\GoalController;
use App\Http\Controllers\SubGoalController;

class SubGoal extends Model
{
    use HasFactory;

    public function goal() {
        return $this->belongsTo(Goal::class);
    }

    public function difficultyMaster() {
        return $this->belongsTo(DifficultyMaster::class);
    }

    // 追加
    /* subgoalsテーブルにレコードを登録する処理⑨ */
    public function createSubGoals(string $title, string $detail = null, int $difficulty_master_id) 
    {
        // subgoalsテーブルにレコードを登録する
        $this->goal_id = session()->get('goal_id');
        $this->title = $title;
        $detail ? $this->detail = $detail : $this->detail = '';
        $this->difficulty_master_id = $difficulty_master_id;
        $this->status = GoalController::GOAL_STATUS_TODO; // 0:未達成
        $this->save();
    }

    /* goalsテーブルに紐づくsubgoalsテーブルのstatusカラムを1:達成済みに更新する処理⑥ */
    public function updateSubGoalsStatus(int $goal) 
    {
        $subgoals = self::where('goal_id', $goal)->get();
        foreach ($subgoals as $subgoal) {
            $subgoal->status = GoalController::GOAL_STATUS_DONE; //1:達成済
            $subgoal->update();
        }
    }

    /* サブ目標設定数を制御する処理⑧ */
    public function countSubGoals(int $goal) 
    {
        // subgoals.createに遷移するたびにsubgoalをカウントアップする
        $subgoal_max = SubGoalController::SUBGOAL_TODO_CNT - 1;
        $subgoal = self::where('goal_id', session()->get('goal_id'))->count();//前画面で設定したgoal_idのレコード数
        $subgoal_array = array();
        // サブ目標設定が最大数に達したかどうかで分岐
        if ($subgoal === $subgoal_max) {
            $subgoal_flag = true;
            ++$subgoal;
        }
        else {
            $subgoal_flag = false;
            ++$subgoal;
        }
        // 配列に格納
        $subgoal_array = array(
            'subgoal' => $subgoal,
            'subgoal_flag' => $subgoal_flag
          );
        return $subgoal_array;
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// 追加
use App\Consts\GoalConsts;
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
    public function createSubGoals(
        string $goal_id,
        string $title,
        string $detail = null,
        int $difficulty_master_id) 
    {
        // subgoalsテーブルにレコードを登録する
        $this->goal_id = $goal_id;
        $this->title = $title;
        $this->detail = empty($detail) ? '' : $detail;
        $this->difficulty_master_id = $difficulty_master_id;
        $this->status = GoalConsts::GOAL_STATUS_TODO; // 0:未達成
        $this->save();
    }

    /* goalsテーブルに紐づくsubgoalsテーブルのstatusカラムを1:達成済みに更新する処理⑥ */
    public function updateSubGoalsStatus(int $goal) 
    {
        $subgoals = self::where('goal_id', $goal)->get();
        foreach ($subgoals as $subgoal) {
            $subgoal->status = GoalConsts::GOAL_STATUS_DONE; //1:達成済
            $subgoal->update();
        }
    }

}

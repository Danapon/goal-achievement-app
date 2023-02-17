<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// 追加
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Consts\GoalConsts;

class Goal extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function subGoals() {
        return $this->hasMany(SubGoal::class);
    }

    // 追加
    /* goalsテーブルにレコードを登録する処理④ */
    public function createGoals(string $title, string $detail = null)
    {
        // goalsテーブルにレコードを登録する
        $this->title = $title;
        $this->detail = empty($detail) ? '' : $detail;
        $this->status = GoalConsts::GOAL_STATUS_TODO; // 0:未達成
        $this->user_id = Auth::id();
        $this->save();
    }    

    /* goalsテーブルのstatusカラムを1:達成済みに更新する処理⑤ */
    public function updateGoalsStatus(int $goals)
    {
        // goalsテーブルのstatusカラムを1:達成済みに更新する
        $goal_status = self::find($goals);
        $goal_status->status = GoalConsts::GOAL_STATUS_DONE; //1:達成済
        $goal_status->update();
    }
}

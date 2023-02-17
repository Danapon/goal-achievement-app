<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SubGoal;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubGoalController extends Controller
{
    
    // サブ目標の最大設定数（この数字を変更すれば設定可能なサブ目標の数を増減可能）
    const SUBGOAL_TODO_CNT = 3;
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {   
        /* サブ目標設定数を制御する処理⑧ */
        // subgoals.createに遷移するたびにsubgoalをカウントアップする
        $subgoal_max = self::SUBGOAL_TODO_CNT - 1;
        $subgoal = SubGoal::where('goal_id', session()->get('goal_id'))->count();//前画面で設定したgoal_idのレコード数
        // サブ目標設定が最大数に達したかどうかで分岐
        if ($subgoal === $subgoal_max) {
            $subgoal_flag = true;
            ++$subgoal;
        }
        else {
            $subgoal_flag = false;
            ++$subgoal;
        }
        /* サブ目標設定数を制御する処理⑧ */

        return view('subgoals.create', compact('subgoal', 'subgoal_flag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        /* subgoalsテーブルにレコードを登録する処理⑨ */
        $subgoal = new SubGoal();
        $subgoal->goal_id = session()->get('goal_id');
        $subgoal->title = $request->input('title');
        $request->input('detail') ? $subgoal->detail = $request->input('detail') : $subgoal->detail = '';
        $subgoal->difficulty_master_id = $request->input('difficulty_master_id');
        $subgoal->status = GoalController::GOAL_STATUS_TODO;
        $subgoal->save();
        /* subgoalsテーブルにレコードを登録する処理⑨ */

        // 押されたボタン(サブ目標設定 or 設定完了)で分岐
        if (intval($request->input('btn')) === 0) {
            return to_route('goals.index');
        }
        else {
            return to_route('subgoals.create');
        }
        
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        /* 取得経験値をusersテーブルのtotal_expに加算する処理⑩ */
        // subgoalsテーブルに紐付いた経験値を取得
        $exp = SubGoal::where('id', $id)->with('difficultymaster:id,exp')->first();
        $get_exp = $exp->difficultymaster->exp;
        // get_expをusersテーブルのtotal_expに加算する
        $user = Auth::user()->increment('total_exp', $get_exp);
        // 経験値取得時のメッセージ
        $flash_message = '経験値  ' . $get_exp . '  を取得しました!!';
        /* 取得経験値をusersテーブルのtotal_expに加算する処理⑩ */

        return to_route('goals.index')->with(compact('flash_message'));
    }

}

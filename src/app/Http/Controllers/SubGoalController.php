<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SubGoal;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// サービスクラス追加
use App\Services\TotalExpService;
use App\Services\SubGoalService;

class SubGoalController extends Controller
{

    private $subgoal_service;
    private $subgoal; 
    private $total_exp_service; 

    public function __construct(
        SubGoalService $subgoal_service,
        SubGoal $subgoal,
        TotalExpService $total_exp_service)
    {
        $this->subgoal_service = $subgoal_service;
        $this->subgoal = $subgoal;
        $this->total_exp_service = $total_exp_service;
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {    
        /* サブ目標設定数を制御する処理⑧ */
        $subgoal_array = $this->subgoal_service->countSubGoals(session()->get('goal_id'));
        /* サブ目標設定数を制御する処理⑧ */

        return view('subgoals.create', compact('subgoal_array'));
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
        $this->subgoal->createSubGoals(
            session()->get('goal_id'),
            $request->input('title'),
            $request->input('detail'),
            $request->input('difficulty_master_id')        
        );
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
        $get_exp = $this->total_exp_service->incrementTotalExp($id);
        /* 取得経験値をusersテーブルのtotal_expに加算する処理⑩ */

        // 経験値取得時のメッセージ
        $flash_message = '経験値  ' . $get_exp . '  を取得しました!!';

        return to_route('goals.index')->with(compact('flash_message'));
    }

}

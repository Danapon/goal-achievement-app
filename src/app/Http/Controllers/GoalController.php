<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Goal;
use App\Models\SubGoal;
use App\Models\DifficultyMaster;
use App\Models\LevelMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TotalExpService;
use App\Services\LevelService;
use App\Services\GoalService;

class GoalController extends Controller
{

    private $total_exp_service;
    private $level_master;
    private $level_service;
    private $user;
    private $goal_service;
    private $goal;
    private $subgoal;

    // コンストラクタインジェクション
    public function __construct(
        TotalExpService $total_exp_service,
        LevelMaster $level_master,
        LevelService $level_service,
        User $user,
        GoalService $goal_service,
        Goal $goal,
        SubGoal $subgoal) 
    {
        //プロパティとして持っておく
        $this->total_exp_service = $total_exp_service;
        $this->level_master = $level_master;
        $this->level_service = $level_service;
        $this->user = $user;
        $this->goal_service = $goal_service;
        $this->goal = $goal;
        $this->subgoal = $subgoal;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // goal_idのセッションを削除
        session()->forget('goal_id');

        // 画面に表示するデータを取得
        $goal_index_view_content = $this->goal_service->getGoalIndexViewContent($this->user->getRelation());

        return view('goals.index', compact( 'goal_index_view_content'));     

    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {   
        return view('goals.create');
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

        /* goalsテーブルにレコードを登録する処理④ */
        $this->goal->createGoals(
            $request->input('title'), 
            $request->input('detail')
        );
        /* goalsテーブルにレコードを登録する処理④ */

        // sugoalsのgoal_idを設定するのに必要
        // goalsのidをセッション変数に保存
        session()->put('goal_id', $this->goal->id);

        return to_route('subgoals.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($goals)
    {   
        /* goalsテーブルのstatusカラムを1:達成済みに更新する処理⑤ */
        $this->goal->updateGoalsStatus($goals);
        /* goalsテーブルのstatusカラムを1:達成済みに更新する処理⑤ */

        /* goalsテーブルに紐づくsubgoalsテーブルのstatusカラムを1:達成済みに更新する処理⑥ */
        $this->subgoal->updateSubGoalsStatus($goals);
        /* goalsテーブルに紐づくsubgoalsテーブルのstatusカラムを1:達成済みに更新する処理⑥ */

        /* usersテーブルのtotal_expをリセットする処理⑦ */
        $this->total_exp_service->resetTotalExp();
        /* usersテーブルのtotal_expをリセットする処理⑦ */

        // 目標達成時のメッセージ
        $achive_message = '目標を達成しました！おめでとうございます！！！';

        return to_route('goals.index')->with(compact('achive_message'));
        
    }

}

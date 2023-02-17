<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Goal;
use App\Models\SubGoal;
use App\Models\DifficultyMaster;
use App\Models\LevelMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{

    /* 目標達成ステータスのクラス定数 */
    const GOAL_STATUS_TODO = 0;//目標未達成
    const GOAL_STATUS_DONE = 1;//目標達成済
    const GOAL_STATUS_CANCELED = 2;//目標キャンセル

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // goal_idのセッションを削除
        session()->forget('goal_id');

        /* レベルを表示させる処理① */
        // 認証されたユーザーを取得
        $users = Auth::user();
        // 累計経験値を取得
        $total_exp = $users->total_exp;
        /* レベルを表示させる処理① */

        /* レベルアップゲージのvalueとmaxに表示させる値を計算する処理② */
        // 値に応じたレベルのレコード(levelカラムとavator_urlカラム)をlevel_mastersテーブルから取得する
        $level_avator = LevelMaster::where('required_exp', '<=', $total_exp)->orderBy('id', 'desc')->first();
        // 現在のrequired_expの値を取得する
        $required_exp = $level_avator->required_exp;
        // レベルアップに必要な経験値を取得する(次のrequired_exp - 現在のrequired_exp)
        // レベルがMAXでなければゲージに必要な値を取得
        if($level_avator->next()) {
            $required_exp_max = ($level_avator->next()->required_exp) - $required_exp;
            // レベルアップゲージの比率を計算
            $current_exp = ($total_exp - $required_exp) / $required_exp_max;
            // レベルアップに必要な経験値
            $next_exp = $required_exp_max - ($total_exp - $required_exp);
        }
        else {
            // レベルMAXのときレベルアップゲージをMAXにする
            $current_exp = 1;
            // compact関数でエラーが出ないように変数にnullを入れておく
            $required_exp_max = null;
            $next_exp = null;
        }
        /* レベルアップゲージのvalueとmaxに表示させる値を計算する処理② */

        /* goalsステータスを取得する処理③ */
        // Usersテーブルからリレーション設定されたテーブルも全て取得
        $goals_origin = User::where('id', Auth::id())->with('goals.subgoals.difficultymaster')->first();
        // goalsレコードが存在するか判定 存在しない場合はtrueを返す
        $goal_check = $goals_origin->goals->isEmpty();
        // goalsレコードが存在する場合は、statusカラムの値をチェックする
        if (!$goal_check) {
            // usersテーブルに紐付いた全てのgoalsレコードを取得
            $goal_all = $goals_origin->goals->all();
            // goalsテーブルからstatusカラムを取得(end()関数で最新のgoalsレコードから取得)
            // 変数を使わないと$goalsに代入する際にエラーとなる（参照渡しが禁止されている）
            $goals = end($goal_all);
            $goal_status = $goals->status;
        }
        else {
            // 以下はcompact関数でエラーにならないための対応
            $goals = [];//goalsレコードが存在しない場合は、空の配列を定義しておく
            $goal_status = self::GOAL_STATUS_TODO;//goalsレコードが存在しない場合は、statusは0:未達成を入れておく
        }
        /* goalsステータスを取得する処理③ */

        return view('goals.index', compact('goals','level_avator', 'goal_check', 'goal_status', 'required_exp_max', 'current_exp', 'next_exp'));

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
        $goal = new Goal();
        $goal->title = $request->input('title');
        $request->input('detail') ? $goal->detail = $request->input('detail') : $goal->detail = '';
        $goal->status = self::GOAL_STATUS_TODO; // 0:未達成
        $goal->user_id = Auth::id();
        $goal->save();
        /* goalsテーブルにレコードを登録する処理④ */

        // sugoalsのgoal_idを設定するのに必要
        // goalsのidをセッション変数に保存
        session()->put('goal_id', $goal->id);

        return to_route('subgoals.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($goal)
    {   
        /* goalsテーブルのstatusカラムを1:達成済みに更新する処理⑤ */
        $goal_status = Goal::find($goal);
        $goal_status->status = self::GOAL_STATUS_DONE; //1:達成済
        $goal_status->update();
        /* goalsテーブルのstatusカラムを1:達成済みに更新する処理⑤ */

        /* goalsテーブルに紐づくsubgoalsテーブルのstatusカラムを1:達成済みに更新する処理⑥ */
        $subgoals = SubGoal::where('goal_id', $goal)->get();
        foreach ($subgoals as $subgoal) {
            $subgoal->status = self::GOAL_STATUS_DONE; //1:達成済
            $subgoal->update();
        }
        /* goalsテーブルに紐づくsubgoalsテーブルのstatusカラムを1:達成済みに更新する処理⑥ */

        /* usersテーブルのtotal_expをリセットする処理⑦ */
        $users = Auth::user();
        // オブジェクトがnullの場合は404エラーとする
        if (!$users) {
            abort(404);
        }
        $users->total_exp = 0;
        $users->update();
        /* usersテーブルのtotal_expをリセットする処理⑦ */

        // 目標達成時のメッセージ
        $achive_message = '目標を達成しました！おめでとうございます！！！';

        return to_route('goals.index')->with(compact('achive_message'));
        
    }

}

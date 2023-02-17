@extends('layouts.app')

@push('styles')
     <link href="{{ asset('/css/goal.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
     <script src="{{ asset('/js/progressbar/progressbar.js') }}"></script>
     <script>
      //LaravelのBladeで使っている変数$current_exp,$next_expをJavascriptの変数で定義する
      const current_exp = @json($goal_index_view_content->getExpArray()['current_exp']);
      const next_exp = @json($goal_index_view_content->getExpArray()['next_exp']);
     </script>
     <script src="{{ asset('/js/script.js') }}"></script>
@endpush

@section('title', '目標表示')
 
@section('content')

<!-- ユーザー名表示 -->
<p class="user_name">ようこそ、{{ Auth::user()->name }}さん</p>

<!-- 目標達成後メッセージ -->
@if(session('achive_message'))
  <p class="achive_message">{{ session('achive_message') }}</p>
@endif

<!-- サブ目標達成後メッセージ -->
@if(session('flash_message'))
  <p class="get_exp_message">{{ session('flash_message') }}</p>
@endif

<!-- アバターセクション -->
<div class="avator">
  <!-- avator_urlカラムからアバターのパスを取得 -->
  <img src="{{ asset($goal_index_view_content->getLevel()->avator_url) }}" alt="アバター" class="avator_image">
  <!-- レベルの数字の部分はlevelカラムから取得する -->
  <p class="level">LV. {{ $goal_index_view_content->getLevel()->level }}</p>
  <!-- レベルアップゲージ、達成ボタンが押されたタイミングでjsで動かす(valueの値を操作する) -->
  <div id="splash_text" ></div>

  @if ($goal_index_view_content->getExpArray()['next_exp'])
  <p class="next_level">次のレベルまであと {{ $goal_index_view_content->getExpArray()['next_exp'] }} 必要です</p>
  @else
  <p class="next_level achive">おめでとうございます！<br>レベルがMAXになりました！</p>
  @endif

</div>

<!-- 目標セクション -->
<!-- $goal_checkがfalse(goalsテーブルに該当のレコードが存在する)のとき 
     かつ、$goal_statusが0:未達成のとき目標セクションを表示させる -->
@if($goal_index_view_content->isExistToDoGoal())
<div class="nes-container is-dark with-title is-centered goal">

  <p class="title section_titile">目標</p>
  
  <p class="goal_title">{{ $goal_index_view_content->getGoals()->title }}</p>
  <p class="goal_detail">{{ $goal_index_view_content->getGoals()->detail }}</p>

  <!-- サブ目標セクション -->
  <div class="subgoal">

    @foreach($goal_index_view_content->getGoals()->subgoals as $subgoal)
      
      <div class="nes-container is-dark with-title subgoal_block">
        <div class="difficulty">
          <p class="difficulty_status">難易度：{{ $subgoal->difficultymaster->difficulty }}
            <span class="difficulty_star">&emsp;{{ str_repeat('★', $subgoal->difficultymaster->star_num) }}</span>
          </p>
        </div>
        <p class="subgoal_title">{{ $subgoal->title }}</p>
        <p class="subgoal_detail">{{ $subgoal->detail }}</p>
        <form action="{{ route('subgoals.update', ['id' => $subgoal->id]) }}" class="subgoal_form" method="post">
          @csrf
          <button type="submit" class="nes-btn is-primary subgoal_btn">達成!</button>
        </form>
      </div>

    @endforeach

  </div>

  <form action="{{ route('goals.update', ['goal' => $goal_index_view_content->getGoals()->id]) }}" class="goal_form" method="post">  
    @csrf
    @method('put')
    <button type="submit" class="nes-btn is-success goal_btn">目標達成!!!</button>
  </form>

</div>

@else
<!-- 初回登録時(goalsのレコードが存在しない場合)もしくはgoalsテーブルのstatusカラムが1:達成済みのとき -->
<!-- いずれチュートリアルでまずは目標設定をしよう！みたいなのを入れたい -->
<div class="first">
  <a class="nes-btn is-success" href="{{ route('goals.create') }}"><p class="first_goal">目標を設定する</p></a>
</div>
@endif

@endsection
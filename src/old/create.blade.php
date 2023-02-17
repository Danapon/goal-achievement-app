@extends('layouts.app')

@push('styles')
     <link href="{{ asset('/css/goal.css') }}" rel="stylesheet" />
@endpush

@section('title', 'サブ目標設定')

@section('section_title_subgoal', 'サブ目標設定')

@section('content')

<div class="set_block">

  <div class="set_inner">
    <h3 class="set_title">目標達成のためにやること&emsp;その{{ $subgoal }}</h3>
  </div>

  <!-- バリデーションのエラーメッセージ -->
  @foreach ($errors->all() as $error)
    <p class="validation">{{ $error }}</p>
  @endforeach

  <form action="{{ route('subgoals.store') }}" class="set_form" method="post">
  @csrf

    <label for="dark_field" style="color:#fff;" class="label_title">タイトル<span class="required_title">&emsp;必須</span></label><br>
    <input name="title" type="text" id="dark_field" class="nes-input is-dark input_title" value="{{ old('title') }}">
    
    <label for="textarea_field" class="label_detail">メモ</label>
    <textarea name="detail" id="textarea_field" class="nes-textarea is-dark input_detail">{{ old('detail') }}</textarea>
    
    <label for="dark_select" style="color:#fff" class="label_select">難易度</label>
    <div class="nes-select is-dark">
      <select required id="dark_select" class="input_select" name="difficulty_master_id">
        <option value="3" {{ old('difficulty_master_id') === '3' ? 'selected' : '' }}>★&emsp;&emsp;&emsp;かんたん</option>
        <option value="2" {{ old('difficulty_master_id') === '2' ? 'selected' : '' }}>★★&emsp;&emsp;ふつう</option>
        <option value="1" {{ old('difficulty_master_id') === '1' ? 'selected' : '' }}>★★★&emsp;むずかしい</option>
      </select>
    </div>
    
    @if (!$subgoal_flag)
    <!-- サブ目標設定数が最大となれば非表示にする(true) -->
    <button type="submit" class="nes-btn next_btn" name="btn" value=1>サブ目標（その{{ $subgoal + 1 }}）設定</button>
    @endif
    <button type="submit" class="nes-btn completed_btn" name="btn" value=0>設定完了</button><br>

  </form>

</div>

@endsection
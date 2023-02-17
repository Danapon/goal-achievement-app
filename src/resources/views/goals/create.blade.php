@extends('layouts.app')

@push('styles')
     <link href="{{ asset('/css/goal.css') }}" rel="stylesheet" />
@endpush

@section('title', '目標設定')

@section('section_title', '目標設定')

@section('content')

<div class="set_block">

  <div class="set_inner">
    <h3 class="set_title">達成したいこと</h3>
  </div>

  <!-- バリデーションのエラーメッセージ -->
  @foreach ($errors->all() as $error)
    <p class="validation">{{ $error }}</p>
  @endforeach

  <form action="{{ route('goals.store') }}" class="set_form" method="post">
  @csrf
    <label for="dark_field" style="color:#fff;" class="label_title">タイトル<span class="required_title">&emsp;必須</span></label><br>
    <input name="title" type="text" id="dark_field" class="nes-input is-dark input_title" value="{{ old('title') }}">
    <label for="textarea_field" class="label_detail">メモ</label>
    <textarea name="detail" id="textarea_field" class="nes-textarea is-dark input_detail">{{ old('detail') }}</textarea>
    <button type="submit" class="nes-btn next_btn">サブ目標設定へ</button>
  </form>

</div>

@endsection

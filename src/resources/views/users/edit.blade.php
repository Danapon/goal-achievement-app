@extends('layouts.app')

@push('styles')
     <link href="{{ asset('/css/auth.css') }}" rel="stylesheet" />
@endpush

@section('title', 'ユーザー情報編集')

@section('section_title_responsive', 'ユーザー情報編集')

@section('content')

<div class="text_center">

  @if(session('status') == "profile-information-updated")
      <div class="alert_success">
          プロフィール情報を更新しました。<br>
          メールアドレスを更新された場合はメールが届いているかご確認下さい。
      </div><br>
  @endif

  @if ($errors->any())
  <div>
      @foreach ($errors->all() as $error)
        <p class="text_error">{{ $error }}</p>
      @endforeach
  </div>
  @endif

  <form method="post" action="{{route('user-profile-information.update')}}" class="form">
    @csrf
    @method('PUT')
    <label for="name" class="text_auth label_block name">{{ __('Name') }}</label>
    <input id="name" type="text" class="nes-input is-dark input_block" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
    <br>
    <label for="email" class="text_auth label_block address">{{ __('Email Address') }}</label>
    <input id="email" type="email" class="nes-input is-dark input_block" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
    <br>
    <button type="submit" class="common_btn">{{ __('Update') }}</button>
  </form>

</div>

@endsection
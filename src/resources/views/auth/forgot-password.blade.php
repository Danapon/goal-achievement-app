@extends('layouts.app')

@push('styles')
     <link href="{{ asset('/css/auth.css') }}" rel="stylesheet" />
@endpush

@section('title', 'パスワード再設定')

@section('section_title_responsive', 'パスワード再設定')

@section('content')

<div class="text_center">

  @if (session('status'))
    <!-- <div class="alert alert-success" role="alert"> -->
    <div class="alert_success" role="alert">
        {{ session('status') }}
    </div>
  @endif

  <p class="text_auth">ご登録時のメールアドレスを入力してください。<br>
  パスワード再発行用のメールをお送りします。</p>

  @if ($errors->any())
  <div>
      @foreach ($errors->all() as $error)
        <p class="text_error">{{ $error }}</p>
      @endforeach
  </div>
  @endif

  <form method="POST" action="{{ route('password.email') }}" class="form">
    @csrf
    <label for="email" class="text_auth label_block address">{{ __('Email Address') }}</label>
    <input id="email" type="email" class="nes-input is-dark input_block" name="email" value="{{ old('email') }}">
    <br>
    <button type="submit" class="common_btn">
      {{ __('Send Password Reset Link') }}
    </button>
  </form>

</div>

@endsection

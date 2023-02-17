@extends('layouts.app')

@push('styles')
     <link href="{{ asset('/css/auth.css') }}" rel="stylesheet" />
@endpush

@section('title', 'パスワードリセット')

@section('section_title_responsive', 'パスワードリセット')

@section('content')

<div class="text_center">

  @if ($errors->any())
  <div>
      @foreach ($errors->all() as $error)
        <p class="text_error">{{ $error }}</p>
      @endforeach
  </div>
  @endif

  <form method="POST" action="{{ route('password.update') }}" class="form">
    @csrf
    <input type="hidden" name="token" value="{{ request()->route('token') }}">
    <label for="email" class="text_auth label_block address">{{ __('Email Address') }}</label>
    <input id="email" type="email" class="nes-input is-dark input_block" name="email" value="{{ old('email') }}" >
    <br>
    <label for="password" class="text_auth label_block password">{{ __('Password') }}</label>
    <input id="password" type="password" class="nes-input is-dark input_block" name="password">
    <br>
    <label for="password-confirm" class="text_auth label_block confirm_password">{{ __('Confirm Password') }}</label>
    <input id="password-confirm" type="password" class="nes-input is-dark input_block" name="password_confirmation" required autocomplete="new-password">
    <br>
    <button type="submit" class="common_btn">
      {{ __('Reset Password') }}
    </button>
  </form>

</div>

@endsection
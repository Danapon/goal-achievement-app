@extends('layouts.app')

@push('styles')
     <link href="{{ asset('/css/auth.css') }}" rel="stylesheet" />
@endpush

@section('title', 'ログイン')

@section('section_title', 'ログイン')

@section('content')

<div class="text_center">

  @if ($errors->any())
  <div>
      @foreach ($errors->all() as $error)
        <p class="text_error">{{ $error }}</p>
      @endforeach
  </div>
  @endif
  
  <form method="post" action="{{route('login')}}" class="form">
    @csrf
    <label for="email" class="text_auth label_block address">{{ __('Email Address') }}</label>
    <input type="text" name="email" class="nes-input is-dark input_block" value="{{old('email')}}"><br>
    <label for="password" class="text_auth label_block password">{{ __('Password') }}</label>
    <input type="password" name="password" class="nes-input is-dark input_block"><br>
    <div style="background-color:#212529; padding: 1rem 0; margin-top: 1rem; margin-bottom: -1rem;">
      <label for="remember" class="checkbox">
        <input class="nes-checkbox is-dark checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <span class="checkbox">{{ __('Remember Me') }}</span>
      </label>
    </div><br>
    <!-- <label class="" for="remember"> -->
      {{-- {{ __('Remember Me') }} --}}
    <!-- </label><br> -->
    <!-- パスワード再入力：<input type="password" name="password_confirmation"><br> -->
    <button type="submit" class="common_btn">{{ __('Login') }}</button><br>
    @if (Route::has('password.request'))
      <a class="text_link" href="{{ route('password.request') }}">
          {{ __('Forgot Your Password?') }}
      </a><br>
    @endif
    <a class="text_link" href="{{ route('register') }}">
          {{ __('Register') }}
    </a>
  </form>

</div>

@endsection
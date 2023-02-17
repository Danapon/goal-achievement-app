@extends('layouts.app')

@push('styles')
     <link href="{{ asset('/css/auth.css') }}" rel="stylesheet" />
@endpush

@section('title', 'パスワード変更')

@section('section_title_responsive', 'パスワード変更')

@section('content')

<div class="text_center">

  @if(session('status') == "password-updated")
      <div class="alert_success">
          パスワードを更新しました。
      </div><br>
  @endif

  @if ($errors->any())
  <div>
      @foreach ($errors->all() as $error)
        <p class="text_error">{{ $error }}</p>
      @endforeach
  </div>
  @endif

  @error('current_password', 'updatePassword')
      <div class="text_error" role="alert">
          <strong>{{ $message }}</strong>
      </div><br>
  @enderror
  @error('password', 'updatePassword')
      <div class="text_error" role="alert">
          <strong>{{ $message }}</strong>
      </div><br>
  @enderror

  <form method="post" action="{{route('user-password.update')}}" class="form">
    @csrf
    @method('PUT')
    <label for="current_password" class="text_auth label_block new_password">{{ __('Current Password') }}</label>
    <input type="password" name="current_password" class="nes-input is-dark input_block @error('current_password', 'updatePassword') is-invalid @enderror" required autofocus>
    <br>
    <label for="password" class="text_auth label_block new_password">{{ __('New Password') }}</label>
    <input type="password" name="password" class="nes-input is-dark input_block @error('password', 'updatePassword') is-invalid @enderror" required autocomplete="new-password">
    <br>
    <label for="confirm_password" class="text_auth label_block confirm_password">{{ __('Confirm Password') }}</label>
    <input type="password" name="password_confirmation" class="nes-input is-dark input_block" required autocomplete="new-password">
    <br>
    <button type="submit" class="common_btn">{{ __('Update') }}</button>
  </form>

</div>

@endsection
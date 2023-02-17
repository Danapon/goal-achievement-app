@extends('layouts.app')

@push('styles')
     <link href="{{ asset('/css/auth.css') }}" rel="stylesheet" />
@endpush

@section('title', '新規登録')

@section('section_title', '新規登録')

@section('content')

<div class="text_center">

  @if ($errors->any())
  <div>
      @foreach ($errors->all() as $error)
        <p class="text_error">{{ $error }}</p>
      @endforeach
  </div>
  @endif
  
  <form method="post" action="{{route('register')}}" class="form">
    @csrf
    <label for="name" class="text_auth label_block name">{{ __('Name') }}</label>
    <input id="name" type="text" class="nes-input is-dark input_block" name="name" value="{{ old('name') }}">
    <br>
    <label for="email" class="text_auth label_block address">{{ __('Email Address') }}</label>
    <input id="email" type="email" class="nes-input is-dark input_block" name="email" value="{{ old('email') }}">
    <br>
    <label for="email" class="text_auth label_block password">{{ __('Password') }}</label>
    <input type="password" name="password" class="nes-input is-dark input_block"><br>
    <label for="email" class="text_auth label_block confirm_password">{{ __('Confirm Password') }}</label>
    <input type="password" name="password_confirmation" class="nes-input is-dark input_block"><br>
    <button type="submit" class="common_btn">{{ __('Register') }}</button>
  </form>

</div>

@endsection
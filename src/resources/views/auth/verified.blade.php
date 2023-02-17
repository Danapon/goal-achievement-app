@extends('layouts.app')

@push('styles')
     <link href="{{ asset('/css/auth.css') }}" rel="stylesheet" />
@endpush

@section('title', 'メール認証完了')

@section('section_title', 'メール確認が完了しました')

@section('content')

<!-- <h3 class="text-center">会員登録ありがとうございます！</h3> -->

<div class="text_center">
  <p class="text_auth">{{ __('You\'ve verified your email address.') }}</p>
  <div class="text_auth">
      <a href="{{ route('goals.index') }}" class="">
        <button type="submit" class="nes-btn common_btn">{{ __('Let\'s get started.') }}</button>
      </a>
  </div>
</div>

@endsection
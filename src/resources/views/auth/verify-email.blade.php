@extends('layouts.app')

@push('styles')
     <link href="{{ asset('/css/auth.css') }}" rel="stylesheet" />
@endpush

@section('title', '仮登録')

@section('section_title_responsive', 'ご登録ありがとうございます！')

@section('content')

<div class="text_center">
  <p class="text_auth">現在、仮会員の状態です。</p>
  <p class="text_auth">ただいま、ご入力頂いたメールアドレス宛に、ご本人様確認用のメールをお送りしました。</p>
  <p class="text_auth">メール本文内のURLをクリックすると本会員登録が完了となります。</p>
  <div class="text_auth">
      <a href="{{ url('/') }}" class="">
        <button type="submit" class="nes-btn common_btn">トップページへ</button>
      </a>
  </div>
</div>

@endsection
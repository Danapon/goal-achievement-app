@extends('layouts.app')

@push('scripts')
      <script src="{{ asset('/js/script.js') }}"></script>
@endpush

@section('title', '目標達成アプリ')

@section('content')

    <main>

      <div class="fv">
        <img src="{{ asset('images/lv10-hero.png') }}" alt="勇者" class="fv_image">
        <div class="fv_block">
          <h2 class="fv_title">目標達成アプリ</h2>
        </div>
      </div>

      <div class="entry">
        <a class="nes-btn entry_btn" href="{{ route('register') }}"><p class="entry_register">はじめから</p></a><br>
        <a class="nes-btn entry_btn" href="{{ route('login') }}"><p class="entry_login">つづきから</p></a>
      </div>

      <hr size="3px" width="200px">

      <div class="entry_google">
        <a href="{{ url('auth/google') }}" class="entry_google_btn">
          <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
        </a>
      </div>

      <div class="description">
        <div class="nes-container is-rounded is-dark with-title description_block sa sa--lr" data-sa_delay="50">
          <p class="title description_title">&#9312;目標を立てて</p>
          <div class="nes-container is-dark description_inner01">
            <p>毎日2時間勉強する</p>
          </div>
          <a class="nes-btn description_btn" href="#">目標設定</a>
        </div>
        <div class="nes-container is-rounded is-dark with-title description_block sa sa--lr" data-sa_delay="250">
        <p class="title description_title">&#9313;目標を達成して</p>
          <div class="description_inner02">
            <img src="{{ asset('images/lv1-hero.png') }}" alt="赤ちゃん" class="description_image01">
            <p class="description_level">LV. 1</p>
          </div>
          <a class="nes-btn description_btn" href="#">達成！</a>
        </div>
        <div class="nes-container is-rounded is-dark with-title description_block sa sa--lr" data-sa_delay="450">
        <p class="title description_title">&#9314;成長しよう！！</p>
          <div class="description_inner03">
            <img src="{{ asset('images/lv2-hero.png') }}" alt="園児" class="description_image02">
            <p class="description_level">LV. 2</p>
          </div>
          <a class="nes-btn description_btn" href="#">目標達成！！！</a>
        </div>
      </div>

    </main>

@endsection
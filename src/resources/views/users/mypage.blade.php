@extends('layouts.app')

@push('styles')
     <link href="{{ asset('/css/auth.css') }}" rel="stylesheet" />
@endpush

@section('title', 'マイページ')

@section('section_title', 'マイページ')

@section('content')

<div class="mypage">
 
         <hr>
 
         <div class="mypage_section">
             <div class="mypage_block">
                 <div class="mypage_inner">
                     <div class="mypage_img_block">
                      <img class="mypage_img" src="../images/lv4-hero.png" alt="ユーザー">
                     </div>
                     <div class="mypage_label_block">
                         <div class="mypage_content_block">
                             <label for="user-name">ユーザー情報編集</label>
                             <p>ユーザー情報を編集します</p>
                         </div>
                     </div>
                 </div>
                 <div class="mypage_allow_block">
                     <a href="{{route('mypage.edit')}}">
                         <img src="../images/allow.png" alt="矢印">
                     </a>
                 </div>
             </div>
         </div>
 
         <hr>
 
         <div class="mypage_section">
             <div class="mypage_block">
                 <div class="mypage_inner">
                     <div class="mypage_img_block">
                      <img class="mypage_img" src="../images/password.png" alt="パスワード">
                     </div>
                     <div class="mypage_label_block">
                         <div class="mypage_content_block">
                             <label for="password">パスワード変更</label>
                             <p>パスワードを変更します</p>
                         </div>
                     </div>
                 </div>
                 <div class="mypage_allow_block">
                     <a href="{{route('mypage.edit_password')}}">
                      <img src="../images/allow.png" alt="矢印">
                     </a>
                 </div>
             </div>
         </div>
 
         <hr>
 
         <div class="mypage_section">
             <div class="mypage_block">
                 <div class="mypage_inner">
                     <div class="mypage_img_block">
                      <img class="mypage_img" src="../images/logout.png" alt="ログアウト">
                     </div>
                     <div class="mypage_label_block">
                         <div class="mypage_content_block">
                             <label for="logout">ログアウト</label>
                             <p>ログアウトします</p>
                         </div>
                     </div>
                 </div>
                 <div class="mypage_allow_block">
                     <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <img src="../images/allow.png" alt="矢印">
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
                 </div>
             </div>
         </div>
 
         <hr>

         <form action="{{ route('mypage.destroy', Auth::user()) }}" method="post" style="text-align: center;">
            @csrf
            @method('delete')                                        
            <button type="submit" class="common_btn" >退会する</button>
        </form>

 </div>

@endsection
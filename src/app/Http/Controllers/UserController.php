<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;// 認証ユーザー取得のため追加
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function mypage()
    {
        $user = Auth::user();

        return view('users.mypage', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();
 
        return view('users.edit', compact('user'));
    }

    public function edit_password()
    {
        return view('users.edit_password');
    }

    public function destroy(User $user) {
        $user->delete();

        return redirect()->route('home.index');
    }

}

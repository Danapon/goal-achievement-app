<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;// メール認証でコメントアウト解除
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// 追加
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'total_exp',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function goals() {
        return $this->hasMany(Goal::class);
    }

    /* getGoalsStatus()メソッドで使用している */
    public function getRelation($relation = ""):User
    {
        // Usersテーブルからリレーション設定されたテーブルを全て取得
        return $this->where('id', Auth::id())->with('goals.subgoals.difficultymaster')->first();
    }
}

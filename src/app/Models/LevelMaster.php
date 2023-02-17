<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelMaster extends Model
{
    use HasFactory;

    // 次のidのレコードを取得する処理
    public function next()
    {
        return $this->where('id', '>', $this->id)->orderBy('id', 'asc')->first();
    }

    /* 現在のレベルのレコードをlevel_mastersテーブルから取得する処理②-1 */
    public function getLevelMaster(int $total_exp):?LevelMaster
    {
        // 値に応じたレベルのレコードをlevel_mastersテーブルから取得する
        return $this->where('required_exp', '<=', $total_exp)->orderBy('id', 'desc')->first();
    }
}

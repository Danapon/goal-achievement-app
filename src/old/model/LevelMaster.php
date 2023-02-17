<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelMaster extends Model
{
    use HasFactory;

    // 次のidのレコードを取得する処理
    public function next() {
        return $this->where('id', '>', $this->id)->orderBy('id', 'asc')->first();
    }
}

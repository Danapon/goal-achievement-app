<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubGoal extends Model
{
    use HasFactory;

    public function goal() {
        return $this->belongsTo(Goal::class);
    }

    public function difficultyMaster() {
        return $this->belongsTo(DifficultyMaster::class);
    }

}

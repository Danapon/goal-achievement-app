<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DifficultyMaster extends Model
{
    use HasFactory;

    public function subGoals() {
        return $this->hasMany(SubGoal::class);
    }
}

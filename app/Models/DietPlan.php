<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietPlan extends Model
{
    protected $fillable = ['trainer_id', 'title', 'description','duration_weeks', 'calories', 'meals_per_day'];

    public function trainer() {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}

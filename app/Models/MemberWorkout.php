<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberWorkout extends Model
{
    protected $fillable = ['user_id', 'workout_id', 'progress_notes', 'day_of_week'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function workout() {
        return $this->belongsTo(Workout::class);
    }
}

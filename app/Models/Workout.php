<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = ['trainer_id', 'name', 'description', 'difficulty_level'];

    public function trainer() {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}

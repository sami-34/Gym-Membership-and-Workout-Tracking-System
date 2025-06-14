<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietPlan extends Model
{
    protected $fillable = ['trainer_id', 'title', 'description'];

    public function trainer() {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}

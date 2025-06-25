<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberDiet extends Model
{
    protected $fillable = ['user_id', 'diet_plan_id', 'notes', 'day_of_week'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function dietPlan() {
        return $this->belongsTo(DietPlan::class);
    }
}


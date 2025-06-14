<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainerProfile extends Model
{
    protected $fillable = ['user_id', 'price_per_month', 'rating', 'description'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

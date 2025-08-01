<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = ['user_id', 'plan_name', 'price', 'start_date', 'end_date', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

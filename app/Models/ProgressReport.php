<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    protected $fillable = ['user_id', 'weight', 'body_fat_percentage', 'muscle_mass', 'recorded_date'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

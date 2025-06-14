<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'trainer_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function trainerProfile() {
        return $this->hasOne(TrainerProfile::class);
    }

    public function memberships() {
        return $this->hasMany(Membership::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function progressReports() {
        return $this->hasMany(ProgressReport::class);
    }

    public function attendances() {
        return $this->hasMany(Attendance::class);
    }
    
    // NEW: member → trainer relationship
    public function trainer() {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    // NEW: trainer → members relationship
    public function members() {
        return $this->hasMany(User::class, 'trainer_id');
    }
}

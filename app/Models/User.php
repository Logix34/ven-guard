<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'profile_picture',
        'code',
        'gender',
        'phone_number',
        'user_type',
        'dob',
        'address',
        'status',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

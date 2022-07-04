<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'role_title',
        'display_name',
        'description',
        'user_id',
        'deleted_at',
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

}

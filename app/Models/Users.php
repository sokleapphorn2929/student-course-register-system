<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use MongoDB\Laravel\Auth\User as Authenticatable;
use MongoDB\Laravel\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = "mongodb";
    protected $collection = "users";
    protected $fillable = [
        // "user_id",
        "username",
        "email",
        "password",
        "profile_pic",
        "role",
        "gender",
        "dob",
    ];

    public function teachers(): HasMany
    {
        return $this->hasMany(Teachers::class, 'user_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Students::class, 'user_id');
    }
}

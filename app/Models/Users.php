<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;
use MongoDB\Laravel\Relations\HasMany;

class Users extends Authenticatable
{
    protected $connection = "mongodb";
    protected $collection = "users";
    protected $fillable = [
        "username",
        "email",
        "password",
        "profile_pic",
        "role",
        "gender",
        "dob",
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Teachers::class, 'user_id');
    }
}

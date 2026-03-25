<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $connection = "mongodb";
    protected $collection = "users";
    protected $fillable = [
        "username",
        "email",
        "password",
        "profile_pic",
        "gender",
        "dob",
    ];
}

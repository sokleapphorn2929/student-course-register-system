<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Courses extends Model
{
    protected $connection = "mongodb";
    protected $collection = "courses";
    protected $fillable = [
        "course_id",
        "course_title",
        "course_description",
        "course_price",
    ];
}

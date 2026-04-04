<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

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

    public function students(): HasMany
    {
        return $this->hasMany(Students::class, 'course_id');
    }
}

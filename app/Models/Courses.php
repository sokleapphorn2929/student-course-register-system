<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;

class Courses extends Model
{
    protected $connection = "mongodb";
    protected $collection = "courses";
    protected $fillable = [
        "teacher_id",
        "course_id",
        "course_title",
        "course_description",
        "course_price",
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Students::class, 'course_id');
    }

    public function teachers(): BelongsTo
    {
        return $this->belongsTo(Teachers::class, 'teacher_id',"_id");
    }
}

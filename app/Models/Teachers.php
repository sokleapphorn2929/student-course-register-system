<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;

class Teachers extends Model
{
    protected $connection = "mongodb";
    protected $collection = "teachers";
    protected $fillable = [
        "user_id",
        "teacher_name",
        "teacher_phone",
        "teacher_address",
        "teacher_dob",
        'hired_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id',"_id");
    }

    public function course(): HasMany
    {
        return $this->hasMany(Courses::class, 'teacher_id');
    }
}

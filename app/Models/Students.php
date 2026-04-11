<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Students extends Model
{
    protected $connection = "mongodb";
    protected $collection = "students";
    protected $fillable = [
        "user_id",
        "std_name",
        "std_phone",
        "std_address",
        "std_dob",
        'course_id',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Courses::class, 'course_id',"_id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id',"_id");
    }
}

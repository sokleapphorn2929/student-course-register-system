<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Enrollments extends Model
{
    protected $connection = "mongodb";
    protected $collection = "enrollments";
    protected $fillable = [
        "std_id",
        "course_id",
        "status",
        "enrolled_at",
        "payment_status",
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Students::class, 'std_id',"_id");
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Courses::class, 'course_id',"_id");
    }
}

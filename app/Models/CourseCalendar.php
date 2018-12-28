<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCalendar extends Model
{
    protected $fillable = [
        'course_id',
        'hour_start',
        'hour_end',
        'day'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

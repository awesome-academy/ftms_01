<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'date_start',
        'date_end',
        'status'
    ];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'regist_course');
    }

    public function calendars()
    {
        return $this->hasMany(CourseCalendar::class);
    }
}

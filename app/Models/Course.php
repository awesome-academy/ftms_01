<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Course extends Model
{
    protected $fillable = [
        'name',
        'image',
        'date_start',
        'date_end',
        'status'
    ];
    protected $appends = ['status_custom'];
    protected $date = ['date_start_custom', 'date_end_custom'];

    public function subjects()
    {
        return $this->hasMany(Subject::class)->withPivot('status');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'regist_course')->withPivot('status');
    }

    public function courseUsers()
    {
        return $this->belongsToMany(User::class, 'user_course');
    }

    public function calendars()
    {
        return $this->hasMany(CourseCalendar::class);
    }

    public function setStatusAtrribute($value)
    {
        $this->attributes['status'] = $value;
    }

    public function getStatusCustomAttribute()
    {
        if ($this->status == config('admin.course_start'))
        {
            return trans('message.start');
        }
        if ($this->status == config('admin.course_ready'))
        {
            return trans('message.ready');
        }
        if($this->status == config('admin.course_end'))
        {
            return trans('message.end');
        }

        return null;
    }

    public function getDateStartCustomAttribute()
    {
        return Carbon::parse($this->date_start)->format(config('admin.date_format'));
    }

    public function getDateEndCustomAttribute()
    {
        return Carbon::parse($this->date_end)->format(config('admin.date_format'));
    }
}

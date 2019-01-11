<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'status'
    ];
    protected $appends = ['status_custom'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'regist_course')->withPivot('status');
    }

    public function content()
    {
        return $this->hasOne(SubjectContent::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function setStatusAttribute($vale)
    {
        $this->attributes['status'] = $vale;
    }

    public function getStatusCustomAttribute()
    {
        if ($this->status == config('admin.subject_ready'))
        {
            return trans('message.subject_ready');
        }
        if($this->status == config('admin.subject_end'))
        {
            return trans('message.subject_end');
        }
    }
}

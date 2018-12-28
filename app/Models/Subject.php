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

    public function users()
    {
        return $this->belongsToMany(User::class, 'regist_course');
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
}

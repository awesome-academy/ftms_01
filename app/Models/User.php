<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];
    protected $appends = ['role_custom'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'regist_course')->withPivot('status');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'regist_course')->withPivot('status');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function setRoleAttribute($value)
    {
        $this->attributes['role'] = $value;
    }

    public function getRoleCustomAttribute()
    {
        if ($this->role == config('admin.admin'))
        {
            return trans('message.admin');
        }
        if ($this->role == config('admin.supervisor'))
        {
            return trans('message.supervisor');
        }
        if ($this->role == config('admin.member'))
        {
            return trans('message.member');
        }
        return null;
    }

    public function userCourses()
    {
        return $this->belongsToMany(Course::class, 'user_course');
    }
}

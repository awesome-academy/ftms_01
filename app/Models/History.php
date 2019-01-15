<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'type'
    ];
    protected $appends = ['type_custom'];
    protected $date = ['created_at_custom'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function getTypeCustomAttribute()
    {
        if($this->type == config('admin.read')) {

            return trans('message.read');
        }
        if($this->type == config('admin.report')) {

            return trans('message.report');
        }
        if($this->type == config('admin.close')) {

            return trans('message.complete');
        }
    }

    public function getCreatedAtCustomAttribute()
    {
        return $this->created_at->format('d-m-Y H:i:s');
    }
}

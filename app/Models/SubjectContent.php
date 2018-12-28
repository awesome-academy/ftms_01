<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectContent extends Model
{
    protected $fillable = [
        'subject_id',
        'content'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}

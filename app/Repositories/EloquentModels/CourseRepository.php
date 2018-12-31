<?php
namespace App\Repositories\EloquentModels;
use App\Repositories\EloquentRepository;

class CourseRepository extends EloquentRepository
{
    public function getModel()
    {
        return \App\Models\Course::class;
    }
}

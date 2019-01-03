<?php
namespace App\Repositories\EloquentModels;
use App\Repositories\EloquentRepository;

class SubjectRepository extends EloquentRepository
{
    public function getModel()
    {
        return \App\Models\Subject::class;
    }
}

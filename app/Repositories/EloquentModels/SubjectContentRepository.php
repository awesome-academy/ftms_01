<?php
namespace App\Repositories\EloquentModels;
use App\Repositories\EloquentRepository;

class SubjectContentRepository extends EloquentRepository
{
    public function getModel()
    {
        return \App\Models\SubjectContent::class;
    }
}

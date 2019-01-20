<?php
namespace App\Repositories\EloquentModels;
use App\Repositories\EloquentRepository;

class ReportRepository extends EloquentRepository
{
    public function getModel()
    {
        return \App\Models\Report::class;
    }
}

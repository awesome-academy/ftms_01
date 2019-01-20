<?php
namespace App\Repositories\EloquentModels;
use App\Repositories\EloquentRepository;

class HistoryRepository extends EloquentRepository
{
    public function getModel()
    {
        return \App\Models\History::class;
    }
}

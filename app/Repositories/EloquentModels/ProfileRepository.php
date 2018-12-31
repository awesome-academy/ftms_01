<?php
namespace App\Repositories\EloquentModels;
use App\Repositories\EloquentRepository;

class ProfileRepository extends EloquentRepository
{
    public function getModel()
    {
        return \App\Models\Profile::class;
    }
}

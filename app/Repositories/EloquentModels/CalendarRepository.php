<?php
namespace App\Repositories\EloquentModels;
use App\Repositories\EloquentRepository;

class CalendarRepository extends EloquentRepository
{
    public function getModel()
    {
        return \App\Models\CourseCalendar::class;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Charts;
use App\Models\User;
use App\Models\Course;
use DB;

class ChartController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', config('admin.admin'))->get();
        $course = Course::all();
        $user_precious1 = User::where( DB::raw('MONTH(created_at)'), '>=', 1)
            ->where(DB::raw('MONTH(created_at)'), '<=', 3)->count();
        $user_precious2 = User::where( DB::raw('MONTH(created_at)'), '>=', 4)
            ->where(DB::raw('MONTH(created_at)'), '<=', 6)->count();
        $user_precious3 = User::where( DB::raw('MONTH(created_at)'), '>=', 7)
            ->where(DB::raw('MONTH(created_at)'), '<=', 9)->count();
        $user_precious4 = User::where( DB::raw('MONTH(created_at)'), '>=', 10)
            ->where(DB::raw('MONTH(created_at)'), '<=', 12)->count();
        $course_precious1 = Course::where( DB::raw('MONTH(created_at)'), '>=', 1)
            ->where(DB::raw('MONTH(created_at)'), '<=', 3)->count();
        $course_precious2 = Course::where( DB::raw('MONTH(created_at)'), '>=', 4)
            ->where(DB::raw('MONTH(created_at)'), '<=', 6)->count();
        $course_precious3 = Course::where( DB::raw('MONTH(created_at)'), '>=', 7)
            ->where(DB::raw('MONTH(created_at)'), '<=', 9)->count();
        $course_precious4 = Course::where( DB::raw('MONTH(created_at)'), '>=', 10)
            ->where(DB::raw('MONTH(created_at)'), '<=', 12)->count();

        $chartMonth = Charts::multiDatabase('bar', 'google')
            ->title(trans('message.statistical_month'))
            ->dataset('user', $users)
            ->dataset('course', $course)
            ->responsive(false)
            ->groupByMonth();
        $chartYear = Charts::multiDatabase('bar', 'google')
            ->title(trans('message.statistical_year'))
            ->dataset('user', $users)
            ->dataset('course', $course)
            ->responsive(false)
            ->groupByYear();
        $chartPrecious = Charts::multi('bar', 'google')
            ->title(trans('message.statistical_precious'))
            ->labels([trans('message.precious1'), trans('message.precious2'), trans('message.precious3'), trans('message.precious4')])
            ->dataset('name', [$user_precious1, $user_precious2, $user_precious3, $user_precious4])
            ->dataset('course', [$course_precious1, $course_precious2, $course_precious3, $course_precious4])
            ->responsive(false);

        return view('admin.charts.index',compact('chartMonth', 'chartYear', 'chartPrecious'));
    }
}

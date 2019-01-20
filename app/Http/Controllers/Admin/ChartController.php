<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Charts;
use App\Models\User;
use App\Models\Course;
use DB;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function index()
    {
        $user_precious = [];

        for ($i=0; $i <=3 ; $i++) {
            $user_precious[] = User::where( DB::raw('MONTH(created_at)'), '>=', ($i*3)+1)
            ->where(DB::raw('MONTH(created_at)'), '<=', (($i+1)*3))->count();
        }
        $course_precious = [];

        for ($i=0; $i <=3 ; $i++) {
            $course_precious[] = Course::where( DB::raw('MONTH(created_at)'), '>=', ($i*3)+1)
            ->where(DB::raw('MONTH(created_at)'), '<=', (($i+1)*3))->count();
        }
        $chartPrecious = Charts::multi('bar', 'google')
            ->title(trans('message.statistical_precious'))
            ->labels([trans('message.precious1'), trans('message.precious2'), trans('message.precious3'), trans('message.precious4')])
            ->dataset('user', [$user_precious['0'], $user_precious['1'], $user_precious['2'], $user_precious['3']])
            ->dataset('course', [$course_precious['0'], $course_precious['1'], $course_precious['2'], $course_precious['3']])
            ->responsive(false);

        $ingredient_user = [];

        for ($i=1; $i <4 ; $i++) {
            $ingredient_user[] = User::where('role', $i)->count();
        }

        $ingredient_course = [];
        for ($i=0; $i <=config('admin.course_end') ; $i++) {
            $ingredient_course[] = Course::where('status', $i)->count();
        }

        $userChart = Charts::create('pie', 'highcharts')
            ->width(480)
            ->title('User')
            ->labels(['Admin', 'Suppervisor', 'Member'])
            ->values([$ingredient_user['0'], $ingredient_user['1'], $ingredient_user['2']])
            ->responsive(false);
        $courseChart = Charts::create('pie', 'highcharts')
            ->width(530)
            ->title('Course')
            ->labels([trans('message.ready'), trans('message.course_study'), trans('message.end')])
            ->values([$ingredient_course['0'], $ingredient_course['1'], $ingredient_course['2']])
            ->responsive(false);

        $users = User::all();
        $courses = Course::all();
        $chartMonth = Charts::multiDatabase('bar', 'google')
            ->title(trans('message.statistical_month'))
            ->dataset('user', $users)
            ->dataset('course', $courses)
            ->responsive(false)
            ->lastByMonth(10);
        $chartYear = Charts::multiDatabase('bar', 'google')
            ->title(trans('message.statistical_year'))
            ->dataset('user', $users)
            ->dataset('course', $courses)
            ->responsive(false)
            ->groupByYear();

        return view('admin.charts.index',compact('chartMonth', 'chartYear', 'chartPrecious', 'userChart', 'courseChart'));
    }
}

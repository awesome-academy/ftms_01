<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkuser');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function showMember()
    {
        $member = User::where('role', config('admin.member'))->paginate(config('admin.paginate_user'));
        return view('admin.user.member', compact('member'));
    }

    public function showSupervisor()
    {
        $supervisor = User::where('role', config('admin.supervisor'))->paginate(config('admin.paginate_user'));
        return view('admin.user.supervisor', compact('supervisor'));
    }

    public function logoutAdmin()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

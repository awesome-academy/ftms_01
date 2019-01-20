<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentModels\UserRepository;
use Auth;

class AdminController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('checkuser');
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $user = Auth::user();

        return view('admin.index', compact('user'));
    }

    public function showMember()
    {
        $member = $this->userRepository->where('role', '=' ,config('admin.member'))->paginate(config('admin.paginate_user'));

        return view('admin.user.member', compact('member'));
    }

    public function showSupervisor()
    {
        $supervisor =  $this->userRepository->where('role', '=',config('admin.supervisor'))->paginate(config('admin.paginate_user'));

        return view('admin.user.supervisor', compact('supervisor'));
    }

    public function deleteMember($id, Request $request)
    {
        try
        {
            $member = $this->userRepository->find($id);

            if (isset($member->profile)) {
                $member->profile->delete();
            }

            $member->courses()->detach();
            $member->reports()->delete();
            $member->delete();

            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return back();
    }

    public function deleteSupperVisor($id, Request $request)
    {
        try
        {
            $suppervisor = $this->userRepository->find($id);

            if (isset($suppervisor->profile)) {
                $suppervisor->profile->delete();
            }

            $suppervisor->userCourses()->detach();
            $suppervisor->delete();

            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return back();
    }

    public function logoutAdmin()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}

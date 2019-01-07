<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Http\Requests\UserRequest;
use App\Upload;

class UserController extends Controller
{
    protected $upload;

    public function __construct(Upload $upload)
    {
        $this->upload = $upload;
    }

    public function index($id)
    {
        $user = User::findOrFail($id);

        return view('profile.index', compact('user'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('profile.member_detail', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        try
        {
            $user = User::findOrFail($id);
            $profile = $request->except('_method', '_token', 'image');
            $nameImg="";
            if (($user->profile) == null)
            {
                $nameImg = $this->upload->uploadAvatar($request->image);
                $profile['user_id'] = $id;
                $profile['image'] = $nameImg;
                Profile::create($profile);
            } else {
                $nameImg = $request->oldImg;
                if($request->has('image'))
                {
                    $nameImg = $this->upload->uploadAvatar($request->image);
                    $profile['image'] = $nameImg;
                }
                $user->update($profile);
                $user->profile->update($profile);
            }
            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return back();
    }
}

<?php
namespace App;
use Illuminate\Http\Request;

class Upload
{
    public function uploadImage($image)
    {
        $nameImg = "";
        if($image)
        {
            $nameImg = time().'-'.$image->getClientOriginalName();
            $image->storeAs('public/image/course', $nameImg);
        }

        return $nameImg;
    }

    public function uploadAvatar($image)
    {
        $nameImg = "";
        if($image)
        {
            $nameImg = time().'-'.$image->getClientOriginalName();
            $image->storeAs('public/image/avatar', $nameImg);
        }

        return $nameImg;
    }
}

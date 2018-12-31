<?php
namespace App\Models;
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
}

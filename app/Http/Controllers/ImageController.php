<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    //
    public function imageUpload(Request $request)
    {
        //$path = $request->file('profilePic')->store('profilePics/'.$request->user()->id);
        $path = $request->file('profilePic')->store('profilePics', 'public');

        $user = $request->user();
        $image = new Image();
        $image->url = $path;
        //env('APP_URL') . "/storage/" . $image->url;
        $image->user_id = $user->id;
        $image->save();

        return response(['message' => 'profile picture saved']);
    }

    public function getImage(Request $request)
    {
        $url = $request->input('url');
        $image = Image::where('url', $url)->orderBy('id', 'desc')->first();
        if ($image) {
            //return response
        }
        return response(['message' => 'could not locate requested image in the database']);
    }
}

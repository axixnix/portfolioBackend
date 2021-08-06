<?php

namespace App\Http\Controllers;

use App\Models\Image;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class ImageController extends Controller
{
    //
    public function imageUpload(Request $request)
    {
        $user = $request->user();
        $image = new Image();
        $image->url = $request->input('url');
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

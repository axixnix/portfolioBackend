<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Site;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    //

    public function updateSite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about' => ['string', 'required']
        ]);
        if ($validator->fails()) {
            return response(['message' => $validator->errors()], 422);
        }
        $site = ['about' => $request->input('about')];
        $storedSite = new Site();
        $storedSite->site_json = json_encode($site);
        $storedSite->user_id = Auth::user()->id;
        $storedSite->ip = $request->ip();
        $storedSite->save();
        return response(['message' => 'Site updated successfully'], 200);
    }

    public function getSite()
    {
        $storedSite = Site::orderBy('id', 'desc')->first();
        return response(['data' => json_decode($storedSite->site_json, true)], 200);
    }

    public function getHomePage()
    {
        $storedSite = json_decode(Site::orderBy('id', 'desc')->first()->site_json, true);
        $storedImage = Image::orderBy('id', 'desc')->first();
        $url = $storedImage->url;
        $path = env('APP_URL') . "/storage/" . $url;
        return response(['data' => [
            'site' => $storedSite,
            'image' => $path
        ]], 200);
    }
}

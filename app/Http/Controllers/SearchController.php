<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class SearchController extends Controller
{
    //
    public function search(Request $request){
        $string = $request->input('string');
        $result = Blog::where('title','LIKE','%'.$string.'%')->get();

         if($result){
            return response(['result'=>$result]);
         }else{
             return response(['message'=>'no blog matches for your search'],404);
         }



    }
}

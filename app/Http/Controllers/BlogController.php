<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\blog;


class BlogController extends Controller
{
    //

    public function getBlog($id){
       $blog = Blog::find($id);

       if($blog){
           return response()->json(['blog'=>$blog],200);
       }
       return response()->json(['message'=>'blog with matching id not found'],404);
    }


    public function getBlogs(){

        $blogs = Blog::all();
        return response()->json(['blogs'=>$blogs],200);

    }
    public function updateBlog(Request $request,$id){
        $blog = Blog::find($id);
        if($blog){
            $blog->title=$request->title;
            $blog->content=$request->content;
            $blog->update();
            return response()->json(['message'=>'blog updated successfully'],200);
        }
        return response()->json(['message'=>'no blog with matching id found'],404);

    }
    public function deleteBlog($id){
     $blog = Blog::find($id);
     if($blog){
         $blog->delete();
         return response()->json(['message'=>'blog deleted successfully'],200);

     }
     return response()->json(['message'=>'no blog with matching id found'],404);
    }
}

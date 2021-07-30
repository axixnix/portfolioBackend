<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\blog;


class BlogController extends Controller
{
    //

    public function getBlog(){

    }
    public function getBlogs(){

        $blogs = Blog::all();
        return response()->json($blogs);

    }
    public function updateBlog(){

    }
    public function deleteBlog(){

    }
}

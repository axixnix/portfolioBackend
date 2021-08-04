<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    //
    public function createBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $user = Auth::user();

        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $user->blogs()->save($blog);

        return response(['message' => 'blog created successfully'], 200);
    }

    public function getBlog($id)
    {
        $blog = Blog::find($id);

        if ($blog) {
            return response()->json(['blog' => $blog], 200);
        }
        return response()->json(['message' => 'blog with matching id not found'], 404);
    }


    public function getBlogs()
    {

        $blogs = Blog::all();
        return response()->json(['blogs' => $blogs], 200);
    }
    public function updateBlog(Request $request, $id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->update();
            return response()->json(['message' => 'blog updated successfully'], 200);
        }
        return response()->json(['message' => 'no blog with matching id found'], 404);
    }
    public function deleteBlog($id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            $blog->delete();
            return response()->json(['message' => 'blog deleted successfully'], 200);
        }
        return response()->json(['message' => 'no blog with matching id found'], 404);
    }
}

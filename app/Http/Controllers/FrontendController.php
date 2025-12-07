<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
class FrontendController extends Controller
{
public function index()
{
    // Fetch 3 most recent blogs
    $recentBlogs = Blog::orderBy('created_at', 'desc')
                       ->take(3)
                       ->get();

    return view('frontend.index', compact('recentBlogs'));
}
 public function blogview($slug)
{
    // Find blog by slug
    $blog = Blog::where('slug', $slug)->firstOrFail();

    return view("frontend.singleblog", compact('blog'));
}


public function allBlogs()
{
    // Fetch all blogs, newest first
    $blogs = Blog::orderBy('created_at', 'desc')->get();

    return view("frontend.blog", compact('blogs'));
}

}

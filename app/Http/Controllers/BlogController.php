<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // ✅ Import Str helper

class BlogController extends Controller
{
  
    public function create()
    {
        // If you just want to show the create form, you don't need all blogs
        // But if admin.blogedit also lists blogs, keep this
        $blogs = Blog::all();
        return view('admin.blogview', compact('blogs'));
    }
    public function addblog(){
          return view('admin.blogcreate');
    }
public function store(Request $request)
{

    $request->validate([
        'title'             => 'required|string|max:255',
        'short_description' => 'required|string|max:300',
        'long_description'  => 'required|string',
        'image'             => 'nullable|mimes:jpg,jpeg,png,webp,gif,avif|max:2048', // same as product code
        'posted_at'         => 'nullable|date',
    ]);

    $path = null;
    if ($request->hasFile('image')) {
        $nextId = (Blog::max('id') ?? 0) + 1; // next blog number
        $extension = $request->file('image')->getClientOriginalExtension(); 
        $fileName = "blog{$nextId}." . $extension;

        $path = $request->file('image')->storeAs(
            "blogs", // save in storage/app/public/blogs
            $fileName,
            'public'
        );
    }

    // Generate unique slug
    $slug = Str::slug($request->title);
    $count = Blog::where('slug', 'like', "{$slug}%")->count();
    if ($count > 0) {
        $slug .= '-' . ($count + 1);
    }

    Blog::create([
        'title'             => $request->title,
        'slug'              => $slug,
        'short_description' => $request->short_description,
        'long_description'  => $request->long_description,
        'image'             => $path,
        'posted_at'         => $request->posted_at ?? now(),
    ]);

    return redirect()->route('blog.view')->with('success', 'Blog created successfully.');
}

    public function edit(Blog $blog)
    {
        return view('admin.blogupdate', compact('blog'));
    }

 public function update(Request $request, Blog $blog)
{
    $request->validate([
        'title'             => 'required|string|max:255',
        'short_description' => 'required|string|max:300',
        'long_description'  => 'required|string',
        'image'             => 'nullable|mimes:jpg,jpeg,png,webp,gif,avif|max:2048',
        'posted_at'         => 'nullable|date',
    ]);

    $data = $request->only([
        'title', 'short_description', 'long_description', 'posted_at'
    ]);

    $data['slug'] = Str::slug($request->title);
    $data['posted_at'] = $request->posted_at ?? now();

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($blog->image && \Storage::disk('public')->exists($blog->image)) {
            \Storage::disk('public')->delete($blog->image);
        }

        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = "blog{$blog->id}." . $extension;

        $data['image'] = $request->file('image')->storeAs(
            'blogs',
            $fileName,
            'public'
        );
    } else {
        $data['image'] = $blog->image; // keep old image
    }

    $blog->update($data);

    return redirect()->route('blog.view')->with('success', 'Blog updated successfully.');
}



    public function destroy(Blog $blog)
{
    if ($blog->image) {
        \Storage::disk('public')->delete($blog->image);
    }
    
    $blog->delete();

    return redirect()->route('blog.view')->with('success', 'Blog deleted successfully.');
}

}

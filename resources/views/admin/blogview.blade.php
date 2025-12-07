@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">All Blogs</h4>
        <a href="{{ route('blog.create') }}" class="btn btn-success">+ Add New Blog</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Short Description</th>
                    <th>Long Description</th>
                    <th>Image</th>
                    <th>Posted At</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td>{{ $blog->id }}</td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->slug }}</td>
                    <td>{{ Str::limit($blog->short_description, 50) }}</td>
                    <td>{{ Str::limit($blog->long_description, 50) }}</td>
                    <td>
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" width="60" class="rounded">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $blog->posted_at ? $blog->posted_at->format('Y-m-d H:i') : '-' }}</td>
                    <td>
                        <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        
                        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No blogs found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

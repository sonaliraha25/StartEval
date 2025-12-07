@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1>Edit Blog Post</h1>
    <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="startup-card p-4 animate-fade-in-up">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Short Description</label>
            <textarea name="short_description" rows="2" class="form-control" maxlength="300" required>{{ old('short_description', $blog->short_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Long Description</label>
            <textarea name="long_description" rows="6" class="form-control" required>{{ old('long_description', $blog->long_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label><br>
            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" width="150" class="mb-2 rounded">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Posted At</label>
            <input type="datetime-local" name="posted_at" class="form-control" value="{{ old('posted_at', optional($blog->posted_at)->format('Y-m-d\TH:i')) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

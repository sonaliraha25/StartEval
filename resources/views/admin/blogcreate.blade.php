@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1>Create Blog Post</h1>

    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="startup-card p-4 animate-fade-in-up">
        @csrf
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Short Description</label>
            <textarea name="short_description" rows="2" class="form-control" maxlength="300" required>{{ old('short_description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Long Description</label>
            <textarea name="long_description" rows="6" class="form-control" required>{{ old('long_description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Posted At</label>
            <input type="datetime-local" name="posted_at" class="form-control" value="{{ now()->format('Y-m-d\TH:i') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <h4 class="mb-4">Edit Product: <strong>{{ $product->name }}</strong></h4>

  <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select class="form-select" name="status" required>
        <option value="live" {{ $product->status == 'live' ? 'selected' : '' }}>Live</option>
        <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="rejected" {{ $product->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Admin Rating</label>
      <input type="hidden" name="admin_rating" id="admin_rating" value="{{ $product->admin_rating }}">
      <div class="d-flex gap-2 star-rating">
        @for ($i = 1; $i <= 5; $i++)
          <i class="bi {{ $i <= $product->admin_rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }} fs-3" data-value="{{ $i }}"></i>
        @endfor
      </div>
    </div>

    <button type="submit" class="btn btn-success mt-3">Update Product</button>
    <a href="{{ route('admin.products') }}" class="btn btn-secondary mt-3">Back</a>
  </form>
</div>

<script>
  const stars = document.querySelectorAll('.star-rating i');
  const ratingInput = document.getElementById('admin_rating');

  stars.forEach(star => {
    star.addEventListener('click', () => {
      const rating = star.getAttribute('data-value');
      ratingInput.value = rating;

      stars.forEach(s => {
        if (s.getAttribute('data-value') <= rating) {
          s.classList.remove('bi-star', 'text-muted');
          s.classList.add('bi-star-fill', 'text-warning');
        } else {
          s.classList.remove('bi-star-fill', 'text-warning');
          s.classList.add('bi-star', 'text-muted');
        }
      });
    });
  });
</script>
@endsection

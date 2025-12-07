@extends('layouts.app') <!-- or your layout -->

@section('content')
<div class="container mt-5">
  <h4 class="mb-4 fw-bold">All Product Listings</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>User Id</th>
          <th>Name</th>
          <th>Status</th>
          <th>Revenue</th>
          <th>Profit</th>
          <th>Asking Price</th>
          <th>Admin Rating</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td>{{ $product->id }}</td>
          <td>{{$product->user_id}}</td>
          <td>{{ $product->title }}</td>
          <td>
            @if($product->status == 'Live')
              <span class="badge bg-success">Live</span>
            @elseif($product->status == 'Draft')
              <span class="badge bg-warning text-dark">Draft</span>
            @else
              <span class="badge bg-secondary">Unknown</span>
            @endif
          </td>
          <td>${{ number_format($product->revenue) }}</td>
          <td>${{ number_format($product->profit) }}</td>
          <td>${{ number_format($product->asking_price) }}</td>
          <td>
            @for ($i = 1; $i <= 5; $i++)
              @if ($i <= $product->admin_rating)
                <i class="bi bi-star-fill text-warning"></i>
              @else
                <i class="bi bi-star text-muted"></i>
              @endif
            @endfor
          </td>
          <td>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

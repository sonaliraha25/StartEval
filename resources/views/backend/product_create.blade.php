@php
    $logo = optional(Auth::user()->startupProfile)->logo;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>StartEval- Startups Dashboard</title>
  <!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Animate on Scroll Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
 <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Tom Select CSS -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">

  <style>
    .user-profile.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 70px;
            margin-left: 50px;
            color: blue;
        }

        .user-profile .dropdown-menu {
            min-width: 120px;
            padding: 0;
            border-radius: 8px;
        }

        .user-profile .dropdown-item {
            padding: 10px 15px;
          
        }

        .user-profile .user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .user-profile .user-name {
            font-weight: 600;
        }

        .user-profile .user-role {
            font-size: 0.85rem;
            color: gray;
        }
    body {
      background: #f8f9fc;
      font-family: 'Manrope', sans-serif;
    }

    .card-form {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
      padding: 30px;
      max-width: 800px;
      margin: auto;
    }

    .form-label {
      font-weight: 600;
      color: #333;
    }

    .form-control,
    .form-select {
      border-radius: 10px;
      border: 1px solid #ced4da;
      transition: all 0.2s ease-in-out;
    }

    .form-control:focus,
    .form-select:focus {
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.2);
      border-color: #0d6efd;
    }

    .btn-primary {
      background: linear-gradient(to right, #0d6efd, #6610f2);
      border: none;
      padding: 12px 30px;
      font-weight: 600;
      border-radius: 12px;
    }

    .btn-primary:hover {
      opacity: 0.95;
    }

    h4 {
      font-weight: 700;
      color: #0d6efd;
    }
  </style>
</head>
<body style="padding-top: 100px;">

  {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light fixed-top pb-3">
        <div class="container-fluid px-3">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="brand-icon me-1">
                   <img src="{{asset('backend/image/logino.png')}}">
                </div>
            </a>
            
            <div class="navbar-nav mx-auto d-none d-lg-flex">
                 <a class="nav-link " href="{{ route('backend.startup_dashboard') }}">                 <i class="fas fa-th-large me-2"></i>Dashboard
                </a>
                 <a class="nav-link" href="#">
                            <i class="fas fa-edit me-2"></i>Edit Profile
                        </a>
                        <a class="nav-link" href="{{route("chat")}}">
                            <i class="fas fa-inbox me-2"></i>Inbox
                        </a>
             
                <a class="nav-link" href="{{route('products.create')}}">
                    <i class="fas fa-chart-line me-2"></i>Add Product
                </a>
            </div>
            
            <div class="d-flex align-items-center">
              
               <div class="dropdown user-profile ms-3">
                <div class="d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img 
                        src="{{ $logo ? asset('storage/' . $logo) : asset('backend/image/default_user.jpg') }}" 
                        alt="User Logo" 
                        height="50" width="50"
                        class="rounded-circle me-2">
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">{{ Auth::user()->account_type === 'startup' ? 'Entrepreneur' : 'Investor' }}</span>
                    </div>
                </div>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="dropdown-item m-0 p-0">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </nav>
  {{-- Page Content --}}
  <div class="container py-5">
    <div class="card-form">
      <h4 class="mb-4">Add New Product</h4>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label class="form-label">Product Name</label>
          <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select" required>
            <option value="Draft">Draft</option>
            <option value="Live">Live</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label">Revenue ($)</label>
            <input type="number" name="revenue" class="form-control" required>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Profit ($)</label>
            <input type="number" name="profit" class="form-control" required>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Asking Price ($)</label>
            <input type="number" name="asking_price" class="form-control" required>
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label">Product Logo (optional)</label>
          <input type="file" name="logo" class="form-control">
        </div>
     <div class="mb-3">
  <label class="form-label">Product Type</label>
 <select name="product_type" class="form-select" required>
    <option value="technology">Technology</option>
    <option value="healthcare">Healthcare</option>
    <option value="finance">Finance</option>
    <option value="education">Education</option>
    <option value="retail">Retail</option>
  </select>
</div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary">Submit Product</button>
        </div>
      </form>
    </div>
  </div>

  <hr class="my-5">
<h5 class="mb-3">Your Products</h5>

@if ($products->count() > 0)
<table class="table table-bordered table-hover bg-white rounded shadow-sm">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Logo</th>
            <th>Name</th>
            <th>Status</th>
            <th>Revenue</th>
            <th>Profit</th>
            <th>Asking Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $index => $product)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>
                @if($product->logo)
                    <img src="{{ asset('storage/' . $product->logo) }}" width="40" class="rounded">
                @else
                    <span class="text-muted">N/A</span>
                @endif
            </td>
            <td>{{ $product->title }}</td>
            <td>
                <span class="badge bg-{{ $product->status === 'Live' ? 'success' : 'warning' }}">
                    {{ $product->status }}
                </span>
            </td>
            <td>${{ number_format($product->revenue) }}</td>
            <td>${{ number_format($product->profit) }}</td>
            <td>${{ number_format($product->asking_price) }}</td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@else
<p class="text-muted">No products added yet.</p>
@endif

 <!-- Tom Select JS -->
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  new TomSelect("#productTypeSelect", {
    plugins: ['remove_button'],
    persist: false,
    create: false,
    placeholder: "Select product types"
  });
</script>

</body>
</html>

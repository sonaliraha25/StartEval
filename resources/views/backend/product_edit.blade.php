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
    </style>
</head>
<body style="padding-top: 100px;">
     <nav class="navbar navbar-expand-lg navbar-light fixed-top pb-3">
        <div class="container-fluid px-3">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="brand-icon me-1">
                   <img src="{{asset('backend/image/logino.png')}}">
                </div>
            </a>
            
            <div class="navbar-nav mx-auto d-none d-lg-flex">
                <a class="nav-link active" href="#">
                    <i class="fas fa-th-large me-2"></i>Dashboard
                </a>
                        <a class="nav-link" href="{{route("chat")}}">
                            <i class="fas fa-inbox me-2"></i>Inbox
                        </a>
             
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-line me-2"></i>Analytics
                </a>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="search-container me-3">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search startups..." class="search-input">
                    </div>
                </div>
                <div class="notification-bell me-3">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </div>
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


  <div class="container py-5">
   <div class="col col-lg-8 m-auto">
     <h4 class="mb-4 ">Edit Product</h4>

    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" name="title" class="form-control" value="{{ $product->title }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
          <option value="Draft" {{ $product->status == 'Draft' ? 'selected' : '' }}>Draft</option>
          <option value="Live" {{ $product->status == 'Live' ? 'selected' : '' }}>Live</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Product Type</label>
        <select name="product_type" class="form-select">
          <option value="technology" {{ $product->product_type == 'technology' ? 'selected' : '' }}>Technology</option>
          <option value="healthcare" {{ $product->product_type == 'healthcare' ? 'selected' : '' }}>Healthcare</option>
          <option value="finance" {{ $product->product_type == 'finance' ? 'selected' : '' }}>Finance</option>
          <option value="education" {{ $product->product_type == 'education' ? 'selected' : '' }}>Education</option>
          <option value="retail" {{ $product->product_type == 'retail' ? 'selected' : '' }}>Retail</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Revenue ($)</label>
          <input type="number" name="revenue" class="form-control" value="{{ $product->revenue }}">
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Profit ($)</label>
          <input type="number" name="profit" class="form-control" value="{{ $product->profit }}">
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Asking Price ($)</label>
          <input type="number" name="asking_price" class="form-control" value="{{ $product->asking_price }}">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Logo (optional)</label>
        <input type="file" name="logo" class="form-control">
        @if($product->logo)
          <img src="{{ asset('storage/' . $product->logo) }}" width="80" class="mt-2">
        @endif
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-primary">Update Product</button>
      </div>
    </form>
   </div>
  </div>
</body>
</html>

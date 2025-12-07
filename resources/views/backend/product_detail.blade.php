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
    <style>
       body {
      font-family: "Manrope", sans-serif;
    }
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
        @if ( Auth::user()->account_type==='startup')
              <div class="navbar-nav mx-auto d-none d-lg-flex">
                <a class="nav-link " href="{{ route('backend.startup_dashboard') }}">
                    <i class="fas fa-th-large me-2"></i>Dashboard
                </a>
                <a class="nav-link" href="{{route('startup.profile.edit')}}">
                            <i class="fas fa-edit me-2"></i>Edit Profile
                        </a>
                        <a class="nav-link" href="{{route("chat")}}">
                            <i class="fas fa-inbox me-2"></i>Inbox
                        </a>
             
                <a class="nav-link" href="{{route('products.create')}}">
                    <i class="fas fa-chart-line me-2"></i>Add Product
                </a>
            </div>
         @else
              <div class="navbar-nav mx-auto d-none d-lg-flex">
            <a class="nav-link active" href="#">
                <i class="fas fa-th-large me-2"></i>Dashboard
            </a>
               <a class="nav-link" href="{{route('investor.profile.edit')}}">
                            <i class="fas fa-edit me-2"></i>Edit Profile
                        </a>
            <a class="nav-link" href="{{route("chat")}}">
                <i class="fas fa-inbox me-2"></i>Inbox
            </a>
            <a class="nav-link" href="{{route('favorites.index')}}">
                <i class="fa-solid fa-heart me-2"></i>Listed Products
            </a>
        </div>

        @endif  
            
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
    <main class="container-fluid px-4 py-4">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4 animate-fade-in">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <a href="{{ url()->previous() }}" class="text-decoration-none text-secondary me-3">
                            <i class="fas fa-arrow-left"></i>
                            <span class="ms-2">Back to Shopify Apps</span>
                        </a>
                        <span class="badge bg-success ms-auto">{{$product->status}}</span>
                    </div>

                    <h1 class="display-6 fw-bold mb-3">{{ $product->title}}</h1>

                    @if($product->admin_rating > 0)
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <small class="text-muted">Admin Review:</small>
                        <div class="d-flex align-items-center text-warning">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $product->admin_rating)
                                    <i class="bi bi-star-fill fs-5"></i>
                                @else
                                    <i class="bi bi-star fs-5 text-muted"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    @endif

                    <div class="d-flex flex-wrap gap-4 text-secondary mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-edit me-2"></i>
                            <span>{{ $product->product_type }}</span>
                        </div>
                      
                        <div class="d-flex align-items-center">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <span>Launched: {{ $product->created_at }}</span>
                        </div>
                    </div>

                    <p class="lead mb-4">{{ $product->description }}</p>

                    <div class="row g-4 mb-4">
                        <div class="col-md-3">
                            <div class="metric-card">
                                <small>Monthly Revenue</small>
                                <h4>${{ number_format($product->revenue) }}</h4>
                                <span class="text-success"><i class="fas fa-arrow-up me-1"></i>15%</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <small>Monthly Profit</small>
                                <h4>${{ number_format($product->profit) }}</h4>
                                <span class="text-success"><i class="fas fa-arrow-up me-1"></i>12%</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <small>Asking Price</small>
                                <h4>${{ number_format($product->asking_price) }}</h4>
                                <span class="badge bg-primary">Negotiable</span>
                            </div>
                        </div>
                      
                    </div>
                </div>
                </div>

                <div class="card shadow-sm mb-4 animate-fade-in">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4">Company Overview</h5>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3">Business Model</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-circle"></i>SaaS subscription</li>
                                    <li><i class="fas fa-circle"></i>One-time purchase options</li>
                                    <li><i class="fas fa-circle"></i>Transaction-based pricing</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3">Key Features</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-circle"></i>AI-powered banner generation</li>
                                    <li><i class="fas fa-circle"></i>Custom template builder</li>
                                    <li><i class="fas fa-circle"></i>Advanced analytics dashboard</li>
                                    <li><i class="fas fa-circle"></i>Multi-language support</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4 animate-fade-in">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4">Growth Opportunities</h5>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-4 rounded-3 bg-light">
                                    <h6 class="fw-bold mb-3">Market Expansion</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li><i class="fas fa-circle"></i>WooCommerce integration</li>
                                        <li><i class="fas fa-circle"></i>International markets</li>
                                        <li><i class="fas fa-circle"></i>Enterprise solutions</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 rounded-3 bg-light">
                                    <h6 class="fw-bold mb-3">Product Development</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li><i class="fas fa-circle"></i>Mobile app development</li>
                                        <li><i class="fas fa-circle"></i>AI-powered recommendations</li>
                                        <li><i class="fas fa-circle"></i>Marketing tool integrations</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card profile-card shadow-sm mb-4 sticky-top" style="top: 90px;">
                    <div class="card-body p-4 text-center">
                        <img src="{{asset('storage/'.$product->logo)}}" alt="Logo" class="rounded-circle mb-3" style="width: 96px; height: 96px;">
                        <h5 class="fw-bold mb-1">{{  $product->user->name }}</h5>
                        <p class="text-secondary mb-3">Founder & CEO</p>
                        <a class="btn btn-primary w-100 mb-2" href="{{ url('/chatify/' . $product->user_id) }}" >
                            <i class="fas fa-comments me-2"></i>Start Discussion
                        </a>
                        
                        
                        <hr class="my-4">
                        
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-user-check text-success me-2"></i>
                            <span class="text-secondary">Verified Provider</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-calendar-alt text-secondary me-2"></i>
                            <span class="text-secondary">Member Since:{{$product->user->created_at}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

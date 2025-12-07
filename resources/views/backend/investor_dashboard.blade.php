   @php
    $logo = optional(Auth::user()->investorProfile)->profile_picture;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StartEval-Investor Dashboard</title>
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top pb-3">
    <div class="container-fluid px-3">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <div class="brand-icon me-1">
                <img src="{{asset('backend/image/logino.png')}}" alt="Brand Logo">
            </div>
        </a>

        <div class="navbar-nav mx-auto d-none d-lg-flex">
            <a class="nav-link active" href="{{ route('backend.investor_dashboard') }}">
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

            <!-- Profile + Dropdown -->
            <div class="dropdown user-profile ms-3">
                <div class="d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img 
                        src="{{ $logo ? asset('storage/' . $logo) : asset('backend/image/default_user.jpg') }}" 
                        alt="User Logo" 
                        height="50" width="50"
                        class="rounded-circle me-2">
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">{{ Auth::user()->account_type === 'investor' ? 'Investor' : 'Entrepreneur' }}</span>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Discover Your Next <span class="text-gradient">Investment</span></h1>
                    <p class="hero-subtitle">Find and evaluate promising startups with our AI-powered platform. Get detailed insights, financial metrics, and growth potential analysis.</p>
                    <div class="hero-actions">
                        <a class="btn btn-primary btn-lg me-3" href="#product">
                            <i class="fas fa-rocket me-2"></i>Start Exploring
                        </a>
                       
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-stats">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ number_format($activeStartups) }}</h3>
                                <p>Active Startups</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ number_format($totalValue) }}K</h3>
                                <p>Total Value</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ number_format($investorsCount) }}</h3>
                                <p>Investors</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
  
            <!-- Featured Startups -->
            <section id="product" class="mb-5 mt-5">
                <div class="section-header">
                    <h2 class="section-title">Featured Products</h2>
                    <p class="section-subtitle">Hand-picked opportunities based on your investment criteria</p>
                </div>
            <div class="row g-4">
    @forelse($matchedProducts as $product)
      <div class="col-md-4">
        <div class="listing-card p-3">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              @if($product->logo)
                <img src="{{ asset('storage/' . $product->logo) }}" width="30" />
              @else
                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968772.png" width="30" />
              @endif
              <div>
                <strong>{{ $product->title }}</strong>
                 <button class="btn btn-sm btn-light favorite-btn" data-id="{{ $product->id }}">
                                    <i class="far fa-heart"></i>
                                </button>
              </div>
            </div>
            <a href="{{ route('products_detail.view', ['id' => $product->id]) }}" 
               class="btn btn-primary mt-2 px-1 py-1 rounded float-end">View</a>
          </div>

          <p class="text-muted mt-2 small">{{ $product->description }}</p>
          <div class="d-flex justify-content-between mt-3">
            <div>
              <i class="bi bi-cash-stack me-1"></i> 
              <strong>${{ number_format($product->revenue) }}</strong>
              <div class="text-muted small">Revenue</div>
            </div>
            <div>
              <i class="bi bi-piggy-bank me-1"></i> 
              <strong>${{ number_format($product->profit) }}</strong>
              <div class="text-muted small">Profit</div>
            </div>
            <div>
              <i class="bi bi-tags me-1"></i> 
              <strong>${{ number_format($product->asking_price) }}</strong>
              <div class="text-muted small">Asking price</div>
            </div>
          </div>

          @if($product->admin_rating)
            <div class="d-flex align-items-center gap-2 mt-2">
              <small class="text-muted">Admin Review:</small>
              <div class="d-flex align-items-center text-warning">
                @for ($i = 1; $i <= 5; $i++)
                  @if ($i <= $product->admin_rating)
                    <i class="bi bi-star-fill fs-6"></i>
                  @else
                    <i class="bi bi-star fs-6 text-muted"></i>
                  @endif
                @endfor
              </div>
            </div>
          @endif
        </div>
      </div>
    @empty
      <p class="text-muted">No matching products found for your interests.</p>
    @endforelse
  </div>

            </section>

            <!-- Trending Startups -->
            <section class="mb-5">
                <div class="section-header">
                    <h2 class="section-title">Trending This Week</h2>
                    <p class="section-subtitle">Startups gaining momentum and investor interest</p>
                </div>
                <div class="row g-4">
    @foreach($recentProducts as $product)
      <div class="col-md-4">
        <div class="listing-card p-3">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              @if($product->logo)
                <img src="{{ asset('storage/' . $product->logo) }}" width="30" />
              @else
                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968772.png" width="30" />
              @endif
              <div>
                <strong>{{ $product->title }}</strong>
                  <button class="btn btn-sm btn-light favorite-btn" data-id="{{ $product->id }}">
                                    <i class="far fa-heart"></i>
                                </button>
              </div>
            </div>
            <a href="{{ route('products_detail.view', ['id' => $product->id]) }}" 
               class="btn btn-primary mt-2 px-1 py-1 rounded float-end">View</a>
          </div>

          <p class="text-muted mt-2 small">{{ $product->description }}</p>
          <div class="d-flex justify-content-between mt-3">
            <div>
              <i class="bi bi-cash-stack me-1"></i> 
              <strong>${{ number_format($product->revenue) }}</strong>
              <div class="text-muted small">Revenue</div>
            </div>
            <div>
              <i class="bi bi-piggy-bank me-1"></i> 
              <strong>${{ number_format($product->profit) }}</strong>
              <div class="text-muted small">Profit</div>
            </div>
            <div>
              <i class="bi bi-tags me-1"></i> 
              <strong>${{ number_format($product->asking_price) }}</strong>
              <div class="text-muted small">Asking price</div>
            </div>
          </div>

         @if($product->admin_rating !== null)
  <div class="d-flex align-items-center gap-2 mt-2">
    <small class="text-muted">Admin Review:</small>
    <div class="d-flex align-items-center text-warning">
      @for ($i = 1; $i <= 5; $i++)
        @if ($i <= (int) $product->admin_rating)
          <i class="bi bi-star-fill fs-6"></i>
        @else
          <i class="bi bi-star fs-6 text-muted"></i>
        @endif
      @endfor
    </div>
  </div>
@endif
        </div>
      </div>
    @endforeach
                </div>
            </section>
        </div>
    </main>
    <script>
document.querySelectorAll('.profile-dropdown .dropdown-menu').forEach(menu => {
  menu.addEventListener('click', function (e) {
    e.stopPropagation();
  });
});
</script>
<script>
document.querySelectorAll('.favorite-btn').forEach(button => {
    button.addEventListener('click', function() {
        let productId = this.getAttribute('data-id');
        let icon = this.querySelector('i');

        fetch(`/favorite/toggle/${productId}`, {
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'added') {
                icon.classList.remove('far');
                icon.classList.add('fas', 'text-white'); // filled red heart
            } else {
                icon.classList.remove('fas', 'text-danger');
                icon.classList.add('far'); // empty heart
            }
        });
    });
});
</script>

    <script src="{{asset('backend/js/jquery-3.7.1.min.js')}}"</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('backend/js/script.js')}}"></script>
</body>
</html>
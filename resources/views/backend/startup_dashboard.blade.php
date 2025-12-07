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
@if ($reports->count() > 0)
    <div class="alert alert-warning">
        <h5><i class="bi bi-exclamation-triangle-fill"></i> Admin Report</h5>
        <ul class="mb-0">
            @foreach ($reports as $report)
                <li>
                    {{ $report->message }}
                    <small class="text-muted d-block">Sent {{ $report->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    </div>
@endif



  <div class="container my-4">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="carddas p-3">
          <h6 class="text-muted">Live Listings</h6>
          <h4>11 <span class="text-danger">▼ 1.7%</span></h4>
          <a href="#" class="text-primary">View Report</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="carddas p-3">
          <h6 class="text-muted">Total Revenue</h6>
<h4>{{ number_format($totalRevenue) }}k <span class="text-success">▲ 9.3%</span></h4>

          <a href="#" class="text-primary">View Report</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="carddas p-3">
          <h6 class="text-muted">Views This Month</h6>
          <h4>412 <span class="text-success">▲ 9.3%</span></h4>
          <a href="#" class="text-primary">View Report</a>
        </div>
      </div>

      <div class="col-md-6">
        <div class="carddas p-3">
          <h6 class="text-muted">Total Revenue</h6>
          <canvas id="revenueChart" height="200"></canvas>
        </div>
      </div>
      <div class="col-md-6">
        <div class="carddas p-3">
          <h6 class="text-muted">Sales Overview</h6>
          <canvas id="salesChart" height="200"></canvas>
        </div>
      </div>

      <div class="col-12 mt-3">
      <div class="container mb-5">
  <h5 class="mb-3 fw-semibold">Your Listings</h5>
  <div class="row g-4">
    
@forelse($products  as $product)
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
            <span class="badge bg-{{ $product->status === 'Live' ? 'primary' : 'warning' }} text-white ms-2">{{ $product->status }}</span>
          </div>
        </div>
       <a href="{{route('products_detail.view', ['id' => $product->id])}}"class="btn btn-primary mt-2 px-1 py-1 rounded float-end">View</a>
      </div>
      
      <p class="text-muted mt-2 small">{{ $product->description }}</p>
      <div class="d-flex justify-content-between mt-3">
        <div>
          <i class="bi bi-cash-stack me-1"></i> <strong>${{ number_format($product->revenue) }}</strong>
          <div class="text-muted small">Revenue</div>
        </div>
        <div>
          <i class="bi bi-piggy-bank me-1"></i> <strong>${{ number_format($product->profit) }}</strong>
          <div class="text-muted small">Profit</div>
        </div>
        <div>
          <i class="bi bi-tags me-1"></i> <strong>${{ number_format($product->asking_price) }}</strong>
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
  <p class="text-muted">No listings yet. Click “+ Add new” to add your first product.</p>
@endforelse


  </div>

  <!-- Add new button -->
  <a href="{{ route('products.create') }}" class="btn btn-primary mt-4 px-4 py-2 rounded-pill float-end">+ Add new</a>
</div>

    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const revenueLabels = @json($revenueLabels);
    const revenueData = @json($revenueValues);
    const salesLabels = @json($salesLabels);
    const salesData = @json($salesValues);
</script>
<script>
const ctxRev = document.getElementById('revenueChart').getContext('2d');
new Chart(ctxRev, {
    type: 'line',
    data: {
        labels: revenueLabels,
        datasets: [{
            label: 'Monthly Revenue',
            data: revenueData,
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13, 110, 253, 0.1)',
            fill: true,
            tension: 0.4
        }]
    }
});

const ctxSales = document.getElementById('salesChart').getContext('2d');
    new Chart(ctxSales, {
        type: 'bar',
        data: {
            labels: salesLabels,
            datasets: [
                {
                    label: 'Total Sales',
                    data: salesData,
                    backgroundColor: '#007bff', // Bootstrap Blue
                    borderColor: '#007bff',
                    borderWidth: 1
                },
                {
                    label: 'Total Revenue',
                    data: revenueData,
                    backgroundColor: '#adb5bd', // Gray
                    borderColor: '#adb5bd',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#000', // Optional: black legend text
                        boxWidth: 20
                    }
                }
            },
            scales: {
                x: {
                    stacked: false,
                    ticks: {
                        callback: function(value) {
                            const label = this.getLabelForValue(value);
                            return label.length === 7 ? label.slice(5) : label; // Show "01", "02", etc.
                        }
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>

  <script src="{{asset('backend/js/script.js')}}"></script>
   <script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/js/jquery-3.7.1.min.js')}}"</script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true
  });
</script>
</body>
</html>

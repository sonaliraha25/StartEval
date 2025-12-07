<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>StartEval Admin Dashboard</title>
   <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    body {
      background-color: #f8f9fc;
      font-family: "Manrope", sans-serif;
    }
      .user-profile.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 2px;
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

    .sidebar {
      width: 250px;
      height: 100vh;
      background: #ffffff;
      padding: 1.5rem 1rem;
      border-right: 1px solid #e2e8f0;
    }
    .sidebar h4 {
      color: #0d6efd;
      font-weight: bold;
      margin-bottom: 2rem;
    }
    .sidebar .nav-link {
      color: #333;
      padding: 10px 15px;
      border-radius: 10px;
      margin-bottom: 5px;
    }
    .sidebar .nav-link.active, .sidebar .nav-link:hover {
      background-color: #e9f3ff;
      color: #0d6efd;
    }
    .navbar {
      background-color: #ffffff;
      border-bottom: 1px solid #e2e8f0;
      padding: 1rem;
    }
    .dashboard-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  padding: 20px;
  transition: all 0.3s ease-in-out;
  transform: translateY(0);
  cursor: pointer;
}

.dashboard-card:hover {
  transform: translateY(-8px) scale(1.02);
  box-shadow: 0 12px 24px rgba(0, 123, 255, 0.2);
  border-left: 4px solid #0d6efd;
}

    .metric-value {
      font-size: 1.5rem;
      font-weight: bold;
    }
    .metric-label {
      color: #6c757d;
    }
    .chart-container {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  padding: 20px;
  margin-top: 20px;
  transition: all 0.3s ease-in-out;
  transform: translateY(0);
}

.chart-container:hover {
  transform: translateY(-6px);
  box-shadow: 0 10px 25px rgba(13, 110, 253, 0.15);
  border-left: 4px solid #0d6efd;
}
  </style>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
      <img src="{{asset('backend/image/logino.png')}}" alt="Logo" style="margin-bottom:20px; margin-right: 10px;">
      <nav class="nav flex-column">
        <a class="nav-link" href="{{route('admin.dashboard')}}">Dashboard</a>
        <a class="nav-link" href="{{route('admin.totalusers')}}">Users</a>
        <a class="nav-link" href="{{route('admin.investors')}}">Investors</a>
        <a class="nav-link" href="{{ route('admin.entrepreneurs') }}">Entrepreneurs</a>
        <a class="nav-link" href="{{route('admin.products')}}">Product Listings</a>
        <a class="nav-link" href="{{route('blog.view')}}">Edit Landing Page</a>
        <a class="nav-link" href="{{route('admin.contacts')}}">Messages</a>
       <form action="{{ route('logout') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="nav-link btn btn-link text-start text-danger p-0 m-0" style="width: 100%;">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
    </button>
</form>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
      <nav class="navbar d-flex justify-content-between align-items-center">
        <form class="d-flex w-50">
          <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </form>
       <div class="dropdown user-profile">
  <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-person-circle me-2"></i>
    <span>Admin</span>
  </a>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
    <li>
     <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
    @csrf
    <button type="submit" class="dropdown-item ">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
    </button>
</form>

    </li>
  </ul>
</div>
      </nav>

      <div class="container-fluid py-4">
    @yield('content')
  </div>
     </div>
        </div>

      
    </div>
  </div>
  @stack('scripts')

  {{-- <script>
    const userGrowthCtx = document.getElementById('userGrowthChart');
    const categoryCtx = document.getElementById('categoryChart');

    new Chart(userGrowthCtx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
          label: 'Users',
          data: [100, 150, 200, 300, 400, 450, 500],
          borderColor: '#0d6efd',
          fill: false
        }]
      }
    });

    new Chart(categoryCtx, {
      type: 'doughnut',
      data: {
        labels: ['AI/ML', 'E-commerce', 'Healthcare'],
        datasets: [{
          data: [30, 40, 30],
          backgroundColor: ['#0d6efd', '#6610f2', '#ffc107']
        }]
      }
    });
  </script> --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('table').DataTable();
    });
</script>
</body>
</html>

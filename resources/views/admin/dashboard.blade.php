
     @extends('layouts.app')
      @section('content')
        <div class="row g-4">
          <div class="col-md-4">
            <div class="dashboard-card">
              <div class="metric-value">{{ number_format($totalUsers) }}</div>
              <div class="metric-label">Total Users</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="dashboard-card">
              <div class="metric-value">{{ $activeStartups }}</div>
              <div class="metric-label">Active Startups</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="dashboard-card">
              <div class="metric-value">{{$totalInvestment }}Tk</div>
              <div class="metric-label">Total Investment</div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-md-6">
            <div class="chart-container">
              <h6>User Growth</h6>
              <canvas id="userGrowthChart"></canvas>
            </div>
          </div>
          <div class="col-md-6">
            <div class="chart-container">
              <h6>Startup Industry Categories</h6>
              <canvas id="categoryChart" style="max-height: 220px;"></canvas>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
            <div class="chart-container">
           <h6>All Users</h6>
<table class="table table-striped table-hover align-middle">
  <thead class="table-light">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Registered</th>
      <th>Actions</th>
    </tr>
  </thead>
   @foreach ($users as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if ($user->account_type === 'investor')
                    <span class="badge bg-info text-dark">Investor</span>
                @elseif ($user->account_type === 'startup')
                    <span class="badge bg-warning text-dark">Entrepreneur</span>
                @else
                    <span class="badge bg-secondary text-white">Admin</span>
                @endif
            </td>
            <td>{{ $user->created_at->format('Y-m-d') }}</td>
            <td>
                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

</table>
@push('scripts')
<script>
const userGrowthChartData = @json($userGrowth);
const categoryChartData = @json($industryStats);

// User Growth Chart
const ctxUser = document.getElementById('userGrowthChart').getContext('2d');
new Chart(ctxUser, {
    type: 'line',
    data: {
        labels: userGrowthChartData.map(item => item.date),
        datasets: [{
            label: 'New Users',
            data: userGrowthChartData.map(item => item.count),
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13,110,253,0.1)',
            fill: true,
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});

// Category Pie Chart
const ctxCategory = document.getElementById('categoryChart').getContext('2d');
new Chart(ctxCategory, {
    type: 'doughnut',
    data: {
        labels: categoryChartData.map(item => item.industry),
        datasets: [{
            label: 'Startups',
            data: categoryChartData.map(item => item.count),
            backgroundColor: ['#0d6efd', '#f59e0b', '#10b981', '#ef4444', '#6366f1'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endpush

            </div>
      @endsection
    
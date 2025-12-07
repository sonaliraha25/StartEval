@extends('layouts.app')
@section('content')
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
@endsection
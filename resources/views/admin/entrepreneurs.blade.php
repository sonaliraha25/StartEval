@extends('layouts.app')
@section('content')
 <div class="row mt-4">
          <div class="col-12">
            <div class="chart-container">
    <h2 class="mb-4">All Entrepreneurs</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
                <tr>
                    <th>ID</th>
                    <th>Business Name</th>
                    <th>Industry</th>
                    <th>Website</th>
                    <th>Owner Name</th>
                    <th>Description</th>
                    <th>Logo</th>
                    <th>Tax Receipt</th>
                    <th>Missing Data?</th>
                    <th>Report</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entrepreneurs as $e)
                <tr>
                    <td>{{$e->id}}</td>
                    <td>{{ $e->business_name }}</td>
                    <td>{{ $e->industry }}</td>
                    <td style="width: 10px;"><a href="{{ $e->website }}" target="_blank">{{ $e->website }}</a></td>
                    <td>{{ $e->owner_name }}</td>
                    <td>{{ $e->description }}</td>
                    <td>
                        @if($e->logo)
                            <img src="{{ asset('storage/' . $e->logo) }}" width="60">
                        @endif
                    </td>
                    <td>
                        @if($e->tax_receipt)
                            <a href="{{ asset('storage/' . $e->tax_receipt) }}" target="_blank">View</a>
                        @endif
                    </td>
                                      <td>
        @if ($e->has_missing_data)
            <ul class="text-danger small">
                @foreach (json_decode($e->missing_fields, true) as $field)
                    <li>{{ ucfirst(str_replace('_', ' ', $field)) }}</li>
                @endforeach
            </ul>
        @else
            <span class="text-success">All data complete</span>
        @endif
    </td>
       <td >
    @if ($e->has_missing_data)
        <form action="{{ route('admin.sendDashboardReport') }}" method="POST">
            @csrf
            <input type="hidden" name="profile_id" value="{{ $e->id }}">
            <textarea name="report_message" class="form-control form-control-sm mb-1" rows="2" placeholder="Enter message...">Please update the following missing fields: 
@foreach (json_decode($e->missing_fields, true) as $field)
- {{ ucfirst(str_replace('_', ' ', $field)) }}
@endforeach</textarea>
            <button type="submit" class="btn btn-sm btn-warning">Send Report</button>
        </form>
    @else
        <span class="text-muted">No action needed</span>
    @endif
    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
          </div>
 </div>
@endsection
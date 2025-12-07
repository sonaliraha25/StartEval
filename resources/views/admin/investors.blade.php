@extends('layouts.app')
@section('content')
 <div class="row mt-4">
          <div class="col-12">
            <div class="chart-container">
    <h2 class="mb-4">All Investors</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Company Name</th>
                    <th>Website</th>
                    <th>Investment Sector</th>
                    <th>Bio</th>
                    <th>Funding Range</th>
                    <th>Profile Picture</th>
                </tr>
            </thead>
            <tbody>
                @foreach($investors as $i)
                <tr>
                    <td>{{$i->id}}</td>
                    <td>{{ $i->full_name }}</td>
                    <td>{{ $i->email }}</td>
                    <td>{{ $i->company }}</td>
                    <td>{{ $i->website }}</td>
                   <td>{{ is_array($i->investment_sectors) ? implode(', ', $i->investment_sectors) : $i->investment_sectors }}</td>
                     <td>{{ $i->bio }}</td>
                      <td>{{ $i->funding_range}}</td>
              <td><img 
    src="{{ asset('storage/' . (is_array($i->profile_picture) ? $i->profile_picture[0] : $i->profile_picture)) }}" 
    width="60" 
    onerror="this.src='{{ asset('images/default-avatar.png') }}'"
>
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
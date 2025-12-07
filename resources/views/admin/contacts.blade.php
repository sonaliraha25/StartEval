@extends('layouts.app')
@section('content')
 <div class="row mt-4">
          <div class="col-12">
            <div class="chart-container">
    <h2 class="mb-4">All Message</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                  <th>Message</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $contacts as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->message}}</td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
          </div>
 </div>
@endsection
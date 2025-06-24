@extends('dashboard.index')

@section('content')
<div class="card">
    <h5 class="card-header">My Vaccine Requests</h5>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Child Name</th>
            <th>Vaccine</th>
            <th>Hospital</th>
            <th>Preferred Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            @forelse ($requests as $request)
                <tr>
                <td><strong>{{ $request->child->name }}</strong></td>
                <td>{{ $request->vaccine->name }}</td>
                <td>{{ $request->hospital->hospital_name }}</td>
                <td>{{ $request->preferred_date }}</td>
                <td>
                @php
                    $badge = match($request->status) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    };
                @endphp
                 <span class="badge bg-{{ $badge }} rounded-pill me-1">{{ $request->status }}</span>
                </td>
                </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No requests found.</td>
            </tr>
            @endforelse
             

        </tbody>
      </table>
    </div>
  </div>
    
@endsection

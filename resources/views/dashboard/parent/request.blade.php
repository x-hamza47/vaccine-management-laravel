@extends('dashboard.index')

@section('content')
<div class="card text-bg-dark">
    <h5 class="card-header">My Vaccine Requests</h5>
    <div class="d-flex">
      <form method="GET" class="row g-3 mb-4 px-4" action="{{ route('parent.requests') }}">
          <div class="col-auto">
              <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
          </div>
          <div class="col-md-auto">
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved
                </option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
          <div class="col-auto">
              <button type="submit" class="btn btn-primary">Search</button>
          </div>
          <div class="col-auto">
              <a href="{{ route('parent.requests') }}" class="btn btn-outline-secondary">Reset</a>
          </div>
      </form>
  </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover table-dark">
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
      <div class="mt-3 px-4">
        {{ $requests->links() }}
    </div>
    </div>
  </div>
    
@endsection

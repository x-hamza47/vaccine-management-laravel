@extends('dashboard.index')

@section('content')
<div class="card">
    <h5 class="card-header">Appointments History</h5>
    <div class="d-flex">
      <form method="GET" class="row g-3 mb-4 px-4" action="{{ route('hospital.appointments.history') }}">
          <div class="col-auto">
              <input type="text" name="search" class="form-control" placeholder="Search patient or vaccine" value="{{ request('search') }}">
          </div>
        <div class="col-auto">
          <select name="sort_by" class="form-select">
              <option disabled selected>Sort By</option>
              <option value="asc" {{ request('sort_by') == 'asc' ? 'selected' : '' }}>Date (Ascending)</option>
              <option value="desc" {{ request('sort_by') == 'desc' ? 'selected' : '' }}>Date (Descending)</option>
          </select>
      </div>
          <div class="col-auto">
              <button type="submit" class="btn btn-primary">Filter</button>
          </div>
          <div class="col-auto">
              <a href="{{ route('hospital.appointments.history') }}" class="btn btn-outline-secondary">Reset</a>
          </div>
      </form>
  </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Child Name</th>
            <th>Vaccine</th>
            <th>Scheduled Date</th>
            <th>Vaccination Status</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

                @forelse ($appointments as $appointment)
                <tr>
                    <td><strong>{{ $appointment->child->name }}</strong></td>
                    <td>{{ $appointment->vaccine->name }}</td>
                    <td>{{ $appointment->FormattedDate }}</td>
                    <td>
                        <span class="badge bg-success rounded-pill me-1">
                            Completed
                        </span>
                    </td>

                    </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center">No scheduled vaccinations available.</td>
                </tr>
                @endforelse
        </tbody>
      </table>
      <div class="mt-3 px-4">
        {{ $appointments->links() }}
    </div>
    </div>
  </div>
    
@endsection


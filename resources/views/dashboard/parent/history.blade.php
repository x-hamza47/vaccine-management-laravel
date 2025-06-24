@extends('dashboard.index')

@section('content')
<div class="card">
    <h5 class="card-header">Vaccinations History</h5>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Child Name</th>
            <th>Vaccine</th>
            <th>Hospital</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            @if ($data->isNotEmpty())
                @foreach ($data as $schedule) 
                    <tr>
                    <td><strong>{{ $schedule->child->name }}</strong></td>
                    <td>{{ $schedule->vaccine->name }}</td>
                    <td>{{ $schedule->FormattedDate }}</td>
                    <td>{{ $schedule->hospital->hospital_name }}</td>
                    <td>
                    @php
                        $status = $schedule->status;
                    @endphp
                
                    @if ($status == 'completed')
                        <span class="badge bg-success rounded-pill me-1">Completed</span>
                    @elseif ($status == 'pending')
                        <span class="badge bg-warning rounded-pill me-1">Pending</span>
                    @else
                        <span class="badge bg-secondary rounded-pill me-1">No Status</span>
                    @endif
    
                    </td>

  
                    </tr>
                @endforeach
            @endif

        </tbody>
      </table>
    </div>
  </div>
    
@endsection

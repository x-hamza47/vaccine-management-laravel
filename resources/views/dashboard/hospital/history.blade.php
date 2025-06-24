@extends('dashboard.index')

@section('content')
<div class="card">
    <h5 class="card-header">Appointments</h5>
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

                    {{-- <td class="d-flex gap-2">                        
                        <div class="form-check form-switch mb-2 ">
                            <input class="form-check-input status-toggle" type="checkbox" id="flexSwitchCheckDefault" @checked($appointment->status == 'completed') data-id="{{ $appointment->id }}"/>
                        </div>
                    </td> --}}
                    </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center">No scheduled vaccinations available.</td>
                </tr>
                @endforelse
                    


        </tbody>
      </table>
    </div>
  </div>
    
@endsection


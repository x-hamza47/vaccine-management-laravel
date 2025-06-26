@extends('dashboard.index')

@section('content')
<div class="card">
    <h5 class="card-header">Appointments</h5>
    <div class="d-flex">
        <form method="GET" class="row g-3 mb-4 px-4" action="{{ route('hospital.appointments') }}">
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
                <a href="{{ route('hospital.appointments') }}" class="btn btn-outline-secondary">Reset</a>
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
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

                @forelse ($appointments as $appointment)
                <tr>
                    <td><strong>{{ $appointment->child->name }}</strong></td>
                    <td>{{ $appointment->vaccine->name }}</td>
                    <td>{{ $appointment->FormattedDate }}</td>
                    <td>
                        <span class="badge bg-{{ $appointment->status == 'completed' ? 'success' : 'warning'}} rounded-pill me-1">
                            {{ $appointment->status }}
                        </span>
                    </td>

                    <td class="d-flex gap-2">                        
                        <div class="form-check form-switch mb-2 ">
                            <input class="form-check-input status-toggle" type="checkbox" id="flexSwitchCheckDefault" @checked($appointment->status == 'completed') data-id="{{ $appointment->id }}"/>
                        </div>
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

@push('scripts')
<script>
    $(document).ready(function(){

        // Status Change
        $('.status-toggle').change(function () { 
           let scheduleId =  $(this).data('id') ;
           let status =  $(this).is(':checked') ? 'completed' : 'pending' ;

           let url = '{{ route("hospital.appointments.update","ID") }}';
           var newUrl = url.replace("ID",scheduleId);

           $.ajax({
            url: newUrl,
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                status : status,
            },
            success: function (response) {
                if(response['status']) {
                    window.location.reload();                    
                } 
            }
           });
            
        });

    })
</script>
    
@endpush
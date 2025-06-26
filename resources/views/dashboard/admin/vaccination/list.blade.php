@extends('dashboard.index')

@section('content')
<div class="card">

    <h5 class="card-header">Upcoming Vaccinations</h5>
    <div class="d-flex">
        <form method="GET" class="row g-3 mb-4 px-4" action="{{ route('vaccination.index') }}">
            <div class="col-auto">
                <input type="text" name="search" class="form-control" placeholder="Search child or parent" value="{{ request('search') }}">
            </div>
            <div class="col-2">
                <select name="hospital_id" class="form-select">
                    <option value="">All Hospitals</option>
                    @foreach ($hospitals as $hospital)
                        <option value="{{ $hospital->id }}" {{ request('hospital_id') == $hospital->id ? 'selected' : '' }}>
                            {{ $hospital->hospital_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <select name="vaccine_id" class="form-select">
                    <option value="">All Vaccines</option>
                    @foreach ($vaccines as $vaccine)
                        <option value="{{ $vaccine->id }}" {{ request('vaccine_id') == $vaccine->id ? 'selected' : '' }}>
                            {{ $vaccine->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            <div class="col-auto">
                <a href="{{ route('vaccination.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Child Name</th>
            <th>Parent Name</th>
            <th>Vaccine</th>
            <th>Scheduled Date</th>
            <th>Hospital</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
                @forelse ($data as $schedule) 
                    <tr>
                    <td><strong>{{ $schedule->child->name }}</strong></td>
                    <td>{{ $schedule->child->parent->name }}</td>
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

                    <td class="d-flex gap-2">                        
                        <div class="form-check form-switch mb-2 ">
                            <input class="form-check-input status-toggle" type="checkbox" id="flexSwitchCheckDefault" @checked($schedule->status == 'completed') data-id="{{ $schedule->id }}"/>
                        </div>
                    </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center text-muted p-3">No Data found.</td>
                </tr>
                @endforelse

        </tbody>
      </table>
      <div class="mt-3 px-4">
        {{ $data->links() }}
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

           let url = '{{ route("vaccination.updateStatus","ID") }}';
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
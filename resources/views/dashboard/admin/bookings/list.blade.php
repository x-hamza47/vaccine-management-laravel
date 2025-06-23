@extends('dashboard.index')

@section('content')
<div class="card">
    <h5 class="card-header">Bookings</h5>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Child Name</th>
            <th>Parent Name</th>
            <th>Vaccine</th>
            <th>Hospital</th>
            <th>Scheduled Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            @if ($data->isNotEmpty())
                @foreach ($data as $schedule) 
                    <tr>
                    <td><strong>{{ $schedule->child->name }}</strong></td>
                    <td>{{ $schedule->child->parent->name }}</td>
                    <td>{{ $schedule->vaccine->name }}</td>
                    <td>{{ $schedule->hospital->hospital_name }}</td>
                    <td>{{ $schedule->FormattedDate }}</td>
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
                @endforeach
            @endif

        </tbody>
      </table>
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
@extends('dashboard.index')

@section('content')
<div class="card">
    <h5 class="card-header">Vaccines</h5>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Vaccine Name</th>
            <th>Availability</th>
            <th>Date Added</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            @if ($vaccines->isNotEmpty())
                @foreach ($vaccines as $vaccine) 
                    <tr>
                    <td><strong>{{ $vaccine->name }}</strong></td>
                    <td>
                        @if ($vaccine->available)
                            <span class="badge bg-success rounded-pill me-1 p-2">Available</span>
                        @else
                            <span class="badge bg-danger rounded-pill me-1">Unavailable</span>
                        @endif
                    </td>
                    <td>{{ $vaccine->created_at->format('F j, Y') }}</td>
                    <td class="d-flex gap-2">                        
                        <div class="form-check form-switch mb-2 ">
                            <input class="form-check-input status-toggle" type="checkbox" id="flexSwitchCheckDefault" @checked($vaccine->available) data-id="{{ $vaccine->id }}"/>
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
           let vaccineId =  $(this).data('id') ;
           let status =  $(this).is(':checked') ? 1 : 0 ;

           let url = '{{ route("vaccine.update","ID") }}';
           var newUrl = url.replace("ID",vaccineId);

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
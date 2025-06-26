@extends('dashboard.index')

@section('content')
<div class="card">
    <h5 class="card-header">Vaccines</h5>
    <div class="d-flex">
        <form method="GET" class="row g-3 mb-4 px-4" action="{{ route('vaccine.index') }}">
            <div class="col-auto">
                <input type="text" name="search" class="form-control" placeholder="Search Vaccine" value="{{ request('search') }}">
            </div>

            <div class="col-md-auto">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            <div class="col-auto">
                <a href="{{ route('vaccine.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
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

                @forelse ($vaccines as $vaccine) 
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
                @empty
                <tr>
                    <td colspan="12" class="text-center text-muted p-3">No Vaccine found.</td>
                </tr>
                @endforelse

        </tbody>
      </table>
      <div class="mt-3 px-4">
        {{ $vaccines->links() }}
    </div>
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
@extends('dashboard.index')

{{-- ! Content --}}
@section('content')

    @can('admin-view')
     @include('dashboard.partials.admin_dashboard')
    @endcan
    
    @can('parent-view')
     @include('dashboard.partials.parent_dash')
    @endcan
    
    @can('hospital-view')
     @include('dashboard.partials.hospital_dash')
    @endcan
    
@endsection
{{-- ! Content End --}}

@can('hospital-view')
@push('scripts')
<script>
    $(document).ready(function() {
        let message = localStorage.getItem('alertMessage');
        let type = localStorage.getItem('alertType');

        if (message) {
            let alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;

            $('#alert-container').html(alertHtml);

            localStorage.removeItem('alertMessage');
            localStorage.removeItem('alertType');

            setTimeout(() => {
                $('.alert').alert('close');
            }, 3000);
        }

        // Status Change
        $('.status-toggle').change(function() {
            let scheduleId = $(this).data('id');
            let status = $(this).is(':checked') ? 'completed' : 'pending';

            let url = '{{ route('vaccination.updateStatus', 'ID') }}';
            var newUrl = url.replace("ID", scheduleId);

            $.ajax({
                url: newUrl,
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status,
                },
                success: function(response) {

                    localStorage.setItem('alertMessage', response.message);
                    localStorage.setItem('alertType', response.status);
                    location.reload();
                }
            });

        });

    })
</script>
@endpush
@endcan


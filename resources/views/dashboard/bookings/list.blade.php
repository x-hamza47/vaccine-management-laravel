@extends('dashboard.index')

@php
    $heading = 'Vaccinations';
    if (auth()->user()->can('admin-view')) {
        $heading = 'Bookings';
    } elseif (auth()->user()->can('hospital-view')) {
        $heading = 'Appointments History';
    } elseif (auth()->user()->can('parent-view')) {
        $heading = 'Vaccinations History';
    }

    $isAdmin = auth()->user()->can('admin-view');
    $isHospital = auth()->user()->can('hospital-view');
    $isParent = auth()->user()->can('parent-view');

@endphp
@section('content')
    <div class="card text-bg-dark">
        <h5 class="card-header">{{ $heading }}</h5>
        <div class="d-flex">
            <form method="GET" class="row g-3 mb-4 px-4" action="{{ route('bookings.index') }}">
                <div class="col-auto">
                    <input type="text" name="search" class="form-control" placeholder="Search child or parent"
                        value="{{ request('search') }}">
                </div>
                @if ($isAdmin || $isParent)
                    <div class="col-2">
                        <select name="hospital_id" class="form-select">
                            <option value="">All Hospitals</option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->id }}"
                                    {{ request('hospital_id') == $hospital->id ? 'selected' : '' }}>
                                    {{ $hospital->hospital_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="col">
                    <select name="vaccine_id" class="form-select">
                        <option value="">All Vaccines</option>
                        @foreach ($vaccines as $vaccine)
                            <option value="{{ $vaccine->id }}"
                                {{ request('vaccine_id') == $vaccine->id ? 'selected' : '' }}>
                                {{ $vaccine->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-auto">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                        </option>
                        <option value="missed" {{ request('status') == 'missed' ? 'selected' : '' }}>Missed</option>
                    </select>
                </div>
                <div class="col-auto">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-dark">

                <thead>
                    <tr>
                        <th>Child Name</th>
                        @if ($isAdmin || $isHospital)
                            <th>Parent Name</th>
                        @endif
                        <th>Vaccine</th>
                        @if ($isAdmin || $isParent)
                            <th>Hospital</th>
                        @endif
                        <th>Scheduled Date</th>
                        <th>Status</th>
                        @if ($isAdmin || $isHospital)
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @forelse ($data as $schedule)
                        <tr>
                            <td><strong>{{ $schedule->child->name }}</strong></td>
                            @if ($isAdmin || $isHospital)
                                <td>{{ $schedule->child->parent->name }}</td>
                            @endif
                            <td>{{ $schedule->vaccine->name }}</td>
                            @if ($isAdmin || $isParent)
                                <td>{{ Str::limit($schedule->hospital->hospital_name, 20, '...') }}</td>
                            @endif
                            <td>{{ $schedule->FormattedDate }}</td>
                            <td>
                                @php
                                    $status = $schedule->status;
                                    $isPast = \Carbon\Carbon::parse($schedule->date)->isPast();
                                @endphp

                                @if ($status == 'completed')
                                    <span class="badge bg-success rounded-pill me-1">Completed</span>
                                @elseif ($status == 'pending' && $isPast)
                                    <span class="badge bg-danger rounded-pill"
                                        title="Scheduled date has passed">Missed</span>
                                @elseif ($status == 'pending')
                                    <span class="badge bg-warning rounded-pill me-1">Pending</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill me-1">No Status</span>
                                @endif

                            </td>
                            @if ($isAdmin || $isHospital)
                                <td class="d-flex gap-2">
                                    <div class="form-check form-switch mb-2 ">
                                        <input class="form-check-input status-toggle" type="checkbox"
                                            id="flexSwitchCheckDefault" @checked($schedule->status == 'completed')
                                            data-id="{{ $schedule->id }}" />
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted p-3">No Booking found.</td>
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
@if ($isAdmin || $isHospital)
    @push('scripts')
        <script>
            $(document).ready(function() {

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
                            if (response['status']) {
                                window.location.reload();
                            }
                        }
                    });

                });

            })
        </script>
    @endpush
@endif

<div id="alert-container" class="position-fixed d-flex align-items-center" style="z-index: 9999;top:10%;right:5%;"></div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-6 mb-4">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div class="card-title">Total Appointments</div>
                <h3 class="d-inline-block ">{{ $totalAppointments }}</h3>
                <a href="{{ route('vaccination.index') }}" class="btn btn-outline-primary btn-sm ms-3">
                    View
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-6 mb-4">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div class="card-title">Pending Appointments</div>
                <h3 class="d-inline-block ">{{ $pendingAppointments }}</h3>
                <a href="{{ route('vaccination.index') }}" class="btn btn-outline-primary btn-sm ms-3">
                    View
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-6 mb-4">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div class="card-title">Completed Appointments</div>
                <h3 class="d-inline-block ">{{ $completedAppointments}}</h3>
                <a href="{{ route('vaccination.index') }}" class="btn btn-outline-primary btn-sm ms-3">
                    View
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row ">
    <div class="col-lg-9 col-md-6 col-6 mb-4 ">
        <div class="card text-bg-dark">
            <h5 class="card-header">Upcoming Appointments</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th>Child Name</th>
                            <th>Vaccine</th>
                            <th>Scheduled Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($appointments as $schedule)
                            <tr>
                                <td><strong>{{ $schedule->child->name }}</strong></td>
                                <td>{{ $schedule->vaccine->name }}</td>
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
                                        <input class="form-check-input status-toggle" type="checkbox"
                                            id="flexSwitchCheckDefault" @checked($schedule->status == 'completed')
                                            data-id="{{ $schedule->id }}" />
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
                <div class="mt-3 text-end px-3 pb-3 text-center">
                    <a href="{{ route('parent.requests') }}" class="btn btn-outline-primary btn-sm ">
                        View More
                    </a>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-6 mb-4 h-100">
        <div class="card text-bg-dark ">
            <div class="card-body">
                <div class="card-title">Vaccinations Completed Today</div>
                <h3>{{ $completedToday }}</h3>
            </div>
        </div>
    </div>
</div>
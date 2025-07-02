<div class="row">
    <div class="col-lg-4 col-md-6 col-6 mb-4">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div class="card-title">My Children</div>
                <h3 class="d-inline-block ">{{ count($childs) }}</h3>
                <a href="{{ route('child.index') }}" class="btn btn-outline-primary btn-sm ms-3">
                    View
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-6 mb-4">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div class="card-title">Vaccine Requests</div>
                <h3 class="d-inline-block ">{{ $totalRequests }}</h3>
                <a href="{{ route('child.index') }}" class="btn btn-outline-primary btn-sm ms-3">
                    View
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-6 mb-4">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div class="card-title">Pending Appointments</div>
                <h3 class="d-inline-block ">{{ $pendingAppointments}}</h3>
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
            <h5 class="card-header">Recent Requests</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-dark">
                    <thead>
                      <tr>
                        <th>Child Name</th>
                        <th>Vaccine</th>
                        <th>Hospital</th>
                        <th>Preferred Date</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
            
                        @forelse ($myRequests as $request)
                            <tr>
                            <td><strong>{{ $request->child->name }}</strong></td>
                            <td>{{ $request->vaccine->name }}</td>
                            <td>{{ $request->hospital->hospital_name }}</td>
                            <td>{{ $request->preferred_date }}</td>
                            <td>
                            @php
                                $badge = match($request->status) {
                                    'pending' => 'warning',
                                    'approved' => 'success',
                                    'rejected' => 'danger',
                                };
                            @endphp
                             <span class="badge bg-{{ $badge }} rounded-pill me-1">{{ $request->status }}</span>
                            </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No requests found.</td>
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
                            <th>Hospital</th>
                            <th>Scheduled Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($Appointments as $schedule)
                            <tr>
                                <td><strong>{{ $schedule->child->name }}</strong></td>
                                <td>{{ $schedule->vaccine->name }}</td>
                                <td>{{ Str::limit($schedule->hospital->hospital_name, 10, '...') }}</td>
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
</div>
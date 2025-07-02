<div class="row">
    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div class="card-title">Total Children</div>
                <h3 class="d-inline-block ">{{ $totalChildren }}</h3>
                <a href="{{ route('child.index') }}" class="btn btn-outline-primary btn-sm ms-3">
                    View
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div class="card-title">Hospitals</div>
                <h3 class="d-inline-block ">{{ count($hospitals ?? []) }}</h3>
                <a href="{{ route('hospital.index') }}" class="btn btn-outline-primary btn-sm ms-3">
                    View
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div class="card-title">Vaccines</div>
                <h3 class="d-inline-block ">{{ $totalVaccines }}</h3>
                <span class="d-inline-flex flex-column float-end">
                    <small class="text-success me-1">Available: {{ $totalAvailableVaccines }}</small>
                    <small class="text-danger">Unavailable: {{ $totalUnvailableVaccines }}</small>
                </span>
                <a href="{{ route('vaccine.index') }}" class="btn btn-outline-primary btn-sm ms-3">
                    View
                </a>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div class="card-title">Appointment Request</div>
                <h3>{{ count($pendingRequests ?? []) }}</h3>
            </div>
        </div>
    </div>

</div>

{{-- Pending Requests Table --}}
<div class="row ">
    <div class="col-lg-9 col-md-6 col-6 mb-4 ">
        <div class="card text-bg-dark">
            <h5 class="card-header">Recent Appointment Requests</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>Child</th>
                            <th>Vaccine</th>
                            <th>Date</th>
                            <th>Hospital & Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingRequests as $request)
                            <tr>
                                <td>{{ $request->child->name }}</td>
                                <td>{{ $request->vaccine->name }}</td>
                                <td>{{ $request->formatted_date }}</td>
                                <td>
                                    <form method="POST" id="approve-form-{{ $request->id }}"
                                        action="{{ route('child.approve.requests', $request->id) }}"
                                        class="d-flex gap-2 align-items-center">
                                        @csrf
                                        <select name="hospital_id"
                                            class="form-select form-select-sm @error('hospital_id') is-invalid @enderror">
                                            <option disabled selected>Select Hospital</option>
                                            @foreach ($hospitals as $hospital)
                                                <option value="{{ $hospital->id }}" @selected($hospital->id == $request->hospital_id)>
                                                    {{ $hospital->hospital_name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="date" name="date"
                                            class="form-control form-control-sm @error('date')is-invalid @enderror"
                                            value="{{ $request->preferred_date }}">
                                    </form>
                                </td>
                                <td class="d-flex gap-2">
                                    <button form="approve-form-{{ $request->id }}"
                                        class="btn btn-sm btn-success d-flex align-items-center">
                                        <i class="bx bx-check fs-6"></i>
                                    </button>
                                    <form method="POST"
                                        action="{{ route('child.reject.requests', $request->id) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-danger d-flex align-items-center">
                                            <i class="bx bx-x fs-6"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">No pending vaccine requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3 text-end px-3 pb-3 text-center">
                    <a href="{{ route('child.pending.requests') }}" class="btn btn-outline-primary btn-sm ">
                        View More Requests
                    </a>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-6 mb-4 h-100">
        <div class="card text-bg-dark mb-4">
            <div class="card-body">
                <div class="card-title">User Request</div>
                <h3>{{ count($userRequests ?? []) }}</h3>
                <div class="mt-3 text-end px-3 pb-3 text-center">
                    <a href="{{ route('user.approval.index') }}" class="btn btn-outline-primary btn-sm ">
                        View More Requests
                    </a>
                </div>
            </div>
        </div>
        <div class="card text-bg-dark ">
            <div class="card-body">
                <div class="card-title">Vaccinations Completed Today</div>
                <h3>{{ $completedToday }}</h3>
            </div>
        </div>
    </div>
</div>

{{-- User Approvals --}}
<div class="row ">
    <div class="col-lg-3 col-md-6 col-6 mb-4 ">
        <div class="card text-bg-dark mb-4">
            <div class="card-body">
                <div class="card-title">Total Users</div>
                <h3>{{ $totalUsers }}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-6 col-6 mb-4 ">
        <div class="card text-bg-dark">
            <h5 class="card-header">Recent User Requests</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Access Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @forelse ($userRequests as $user)
                            <tr>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                @php
                                    $type = $user->role == 'hospital' ? 'primary' : 'success';
                                @endphp
                                <td>
                                    <span class="badge text-bg-{{ $type }} p-2 ">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="d-flex gap-2">
                                    {{-- ! Approve Button --}}
                                    <form action="{{ route('user.approval.approve', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn-primary btn-sm btn fs-4 text-white d-flex align-items-center justify-content-center"
                                            data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                            data-bs-html="true" title=" <span>Approve</span>">
                                            <i class="bx bx-check"></i>
                                        </button>
                                    </form>

                                    {{-- ! Reject Button --}}
                                    <button type="button"
                                        class="btn btn-sm btn-danger delete-btn fs-4 text-white d-flex align-items-center justify-content-center"
                                        data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center text-muted p-3">No Request found.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="mt-3 text-end px-3 pb-3 text-center">
                    <a href="{{ route('user.approval.index') }}" class="btn btn-outline-primary btn-sm ">
                        View More Requests
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
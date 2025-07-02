@extends('dashboard.index')

@section('content')
    <div class="card text-bg-dark">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header d-flex">All Child List</h5>
            @can('parent-view')
                <span class="px-4">
                    <a href="{{ route('child.create') }}"class="btn btn-primary d-flex align-items-center gap-1">
                        <i class="bx bx-plus fs-5 fw-bold"></i>
                        <p class="m-0" style="line-height: 1.9">Add Child</p>
                    </a>
                </span>
            @endcan
        </div>
        <div class="px-4">
            <form method="GET" action="{{ route('child.index') }}" class="row g-3 align-items-center mb-4">
                <div class="col-auto">
                    <input type="text" name="search" class="form-control" placeholder="Search child or parent"
                        value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <select name="gender" class="form-select">
                        <option value="">All Genders</option>
                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('child.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-bordered table-dark text-center">
                <thead>
                    <tr class="align-middle">
                        <th rowspan="2" class="fw-bold">Child Name</th>
                        <th rowspan="2" class="fw-bold">Date of Birth</th>
                        <th rowspan="2" class="fw-bold">Gender</th>
                        @can('admin-view')
                            <th rowspan="2" class="fw-bold">Parent Name</th>
                        @endcan
                        <th colspan="2" class="fw-bold">Vaccination Status</th>
                        <th rowspan="2" class="fw-bold">Registered On</th>
                        <th rowspan="2" class="fw-bold">Actions</th>
                    </tr>
                    <tr>
                        <th><i class="bx bx-time-five text-warning fs-5 "></i>Pending</th>
                        <th><i class="bx bx-check-double text-success fs-5"></i>Completed</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($childs as $child)
                        @php
                            $pendingCount = $child->vaccinationSchedules->where('status', 'pending')->count();
                            $completedCount = $child->vaccinationSchedules->where('status', 'completed')->count();
                        @endphp
                        <tr>
                            <td><strong>{{ $child->name }}</strong></td>
                            <td>{{ $child->dob }}</td>
                            <td>{{ ucfirst($child->gender) }}</td>
                            @can('admin-view')
                                <td>{{ $child->parent->name }}</td>
                            @endcan
                            <td>
                                @if ($pendingCount > 0)
                                    <span class="badge text-bg-warning rounded-circle p-2 ">
                                        {{ $pendingCount }}
                                    </span>
                                @else
                                    <span class="text-muted">0</span>
                                @endif
                            </td>
                            <td>
                                @if ($completedCount > 0)
                                    <span class="badge text-bg-success rounded-circle ">
                                        {{ $completedCount }}
                                    </span>
                                @else
                                    <span class="text-muted">0</span>
                                @endif
                            </td>
                            <td>{{ $child->created_at->format('F j, Y') }}</td>
                            <td class="d-flex gap-2 align-items-center justify-content-center">
                                <a class="btn-primary btn-sm btn fs-4 text-white d-flex align-items-center justify-content-center"
                                    href="{{ route('child.edit', $child->id) }}" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                    title="<i class='bx bx-edit' ></i> <span>Edit Child</span>">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <form action="{{ route('child.destroy', $child->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-sm btn-danger fs-4 text-white d-flex align-items-center justify-content-center"
                                        data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                        data-bs-html="true" title="<i class='bx bx-trash'></i> <span>Delete Child</span>">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
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
                {{ $childs->links() }}
            </div>
        </div>
    </div>
@endsection

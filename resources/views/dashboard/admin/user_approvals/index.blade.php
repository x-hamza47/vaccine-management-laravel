@extends('dashboard.index')

@section('content')
<div class="card text-bg-dark">
    <h5 class="card-header">All Approvals</h5>

    {{-- Filter Form --}}
    <div class="d-flex">
        <form method="GET" class="row g-3 mb-4 px-4" action="{{ route('user.approval.index') }}">
            <div class="col-auto">
                <input type="text" name="search" class="form-control" placeholder="Search name or email" value="{{ request('search') }}">
            </div>
            <div class="col-auto">
                <select name="role" class="form-select">
                    <option disabled selected>--Filter By--</option>
                    <option value="parent" {{ request('role') == 'parent' ? 'selected' : '' }}>Parent</option>
                    <option value="hospital" {{ request('role') == 'hospital' ? 'selected' : '' }}>Hospital</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            <div class="col-auto">
                <a href="{{ route('user.approval.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    {{-- Table with Bulk Form --}}
    <div class="table-responsive text-nowrap">
        <form method="POST" action="{{ route('user.approval.bulkApprove') }}" id="bulkApproveForm">
            @csrf
            @method('PUT')

            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all" class="form-check-input"></th>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Access Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="form-check-input">
                            </td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            @php
                                $type = $user->role === 'hospital' ? 'primary' : 'success';
                            @endphp
                            <td>
                                <span class="badge text-bg-{{ $type }} p-2">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td class="d-flex gap-2">
                                {{-- Single Approve Form --}}
                                <form method="POST" action="{{ route('user.approval.approve', $user->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-primary fs-4 text-white d-flex align-items-center justify-content-center" title="Approve">
                                        <i class="bx bx-check"></i>
                                    </button>
                                </form>

                                {{-- Delete Button --}}
                                <button type="button"
                                    class="btn btn-sm btn-danger delete-btn fs-4 text-white d-flex align-items-center justify-content-center"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
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

            <div class="mt-3 px-4">
                <button type="submit" class="btn btn-success">Approve Selected</button>
            </div>
        </form>

        <div class="mt-3 px-4">
            {{ $users->links() }}
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="username"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Delete button logic
        $('.delete-btn').click(function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            $('#username').text(name);
            let route = `{{ route('user.approval.reject', ':id') }}`.replace(':id', id);
            $('#deleteForm').attr('action', route);
        });

        // Select all checkboxes
        $('#select-all').click(function () {
            $('input[name="user_ids[]"]').prop('checked', this.checked);
        });
    });
</script>
@endpush

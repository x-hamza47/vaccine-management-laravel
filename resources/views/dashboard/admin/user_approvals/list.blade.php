@extends('dashboard.index')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card text-bg-dark">
        <h5 class="card-header">All Approvals</h5>
        <div class="d-flex">
            <form method="GET" class="row g-3 mb-4 px-4" action="{{ route('user.approval.index') }}">
                <div class="col-auto">
                    <input type="text" name="search" class="form-control" placeholder="Search name or email"
                        value="{{ request('search') }}">
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

        <div class="table-responsive text-nowrap">
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
                <tbody class="table-border-bottom-0">

                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" name="user_ids[]" value="{{ $user->id }}""
                                    class="form-check-input user-checkbox">
                            </td>
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
                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-bs-toggle="modal"
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
            <!-- Bulk Buttons -->
            <div class="mt-3 px-4  gap-2" id="bulk-actions" style="display: none;">
                <button type="submit" class="btn btn-success" data-action="{{ route('user.approval.bulkApprove') }}"
                    data-method="PUT" form="bulkActionForm">
                    Approve Selected
                </button>

                <button type="submit" class="btn btn-danger" data-action="{{ route('user.approval.bulkDelete') }}"
                    data-method="DELETE" form="bulkActionForm">
                    Delete Selected
                </button>
            </div>
            <div class="mt-3 px-4">
                {{ $users->links() }}
            </div>
        </div>
        <form method="POST" action="" id="bulkActionForm">
            @csrf
            <input type="hidden" name="_method" id="form-method">
        </form>
    </div>

    <!-- Delete Confirmation Modal -->
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
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#username').text(name);
                let route = `{{ route('user.approval.reject', ':id') }}`.replace(':id', id);

                $('#deleteForm').attr('action', route);
            });
        });


        $('.user-checkbox, #select-all').on('change', function() {
            const anyChecked = $('.user-checkbox:checked').length > 0;
            if (anyChecked) {
                $('#bulk-actions').slideDown(200);
            } else {
                $('#bulk-actions').slideUp(200);
            }
        });

        // Select all toggle
        $('#select-all').on('change', function() {
            $('.user-checkbox').prop('checked', $(this).is(':checked')).trigger('change');
        });

        // Dynamic form action
        // When a bulk button is clicked
        $('#bulk-actions button[type="submit"]').on('click', function(e) {
            e.preventDefault();

            const action = $(this).data('action');
            const method = $(this).data('method');

            // Set form action and _method
            $('#bulkActionForm').attr('action', action);
            $('#form-method').val(method);

            // Remove any previous hidden checkboxes
            $('#bulkActionForm input[name="user_ids[]"]').remove();

            // Add selected checkboxes to the form
            $('.user-checkbox:checked').each(function() {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'user_ids[]',
                    value: $(this).val()
                }).appendTo('#bulkActionForm');
            });

            // Submit the form
            $('#bulkActionForm').submit();
        });
    </script>
@endpush

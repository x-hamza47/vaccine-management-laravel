@extends('dashboard.index')

@section('content')
    <div class="card text-bg-dark">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">All Hospitals List</h5>
            <span class="px-4">
                <a href="{{ route('hospital.create') }}"class="btn btn-primary d-flex align-items-center gap-1">
                    <i class="bx bx-plus fs-5 fw-bold"></i>
                    <p class="m-0" style="line-height: 1.9">Add Hospital</p>
                </a>
            </span>
        </div>
        <div class="d-flex">
            <form method="GET" class="row g-3 mb-4 px-4" action="{{ route('hospital.index') }}">
                <div class="col-auto">
                    <input type="text" name="search" class="form-control" placeholder="Search hospital or location"
                        value="{{ request('search') }}">
                </div>

                <div class="col-auto">
                    <select name="sort_by" class="form-select">
                        <option disabled selected>Sort By</option>
                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="date" {{ request('sort_by') == 'date' ? 'selected' : '' }}>Date (Newest First)
                        </option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('hospital.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th>Hospital Name</th>
                        <th>Address</th>
                        <th>Location</th>
                        <th>Registered Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">


                    @forelse ($hospitals as $hospital)
                        <tr>
                            <td><strong>{{ $hospital->hospital_name }}</strong></td>
                            <td data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                title="<span>{{ $hospital->address }}</span>">
                                {{ $hospital->short_address }}
                            </td>
                            <td>{{ $hospital->location }}</td>
                            <td>{{ $hospital->user->email }}</td>
                            <td class="d-flex gap-2">
                                <a class="btn-primary btn-sm btn fs-4 text-white d-flex align-items-center justify-content-center"
                                    href="{{ route('hospital.edit', $hospital->id) }}" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                    title="<i class='bx bx-edit' ></i> <span>Edit</span>">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger delete-btn fs-4 text-white d-flex align-items-center justify-content-center" 
                                    data-id="{{ $hospital->id }}" data-name="{{ $hospital->hospital_name }}"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted p-3">No Hospital found.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            <div class="mt-3 px-4">
                {{ $hospitals->links() }}
            </div>
        </div>
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
                <p>Are you sure you want to delete <strong id="hospitalName"></strong>?</p>
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
        $('.delete-btn').click(function () {
            var id = $(this).data('id');
            var name = $(this).data('name');

            $('#hospitalName').text(name);
            let route = `{{ route('hospital.destroy', ':id') }}`.replace(':id', id);
            
            $('#deleteForm').attr('action', route);
        });
    });
</script>
@endpush


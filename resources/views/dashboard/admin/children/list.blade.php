@extends('dashboard.index')

@section('content')



<div class="card">
    <h5 class="card-header">All Child List</h5>
    <div class="px-4 ">
        <form method="GET" action="{{ route('child.index') }}" class="row g-3 align-items-center mb-4">
            <div class="col-auto">
                <input type="text" name="search" class="form-control" placeholder="Search child or parent" value="{{ request('search') }}">
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
        </form>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Child Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Parent Name</th>
            <th>Vaccination Status</th>
            <th>Registered On</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">


                @forelse ($childs as $child) 
                    <tr>
                    <td><strong>{{ $child->name }}</strong></td>
                    <td>{{ $child->dob }}</td>
                    <td>{{ ucfirst($child->gender) }}</td>
                    <td>{{ $child->parent->name }}</td>
                    <td >
                     @php
                        $pendingCount = $child->vaccinationSchedules->where('status', 'pending')->count();
                        $completedCount = $child->vaccinationSchedules->where('status', 'completed')->count();
                    @endphp
                    
                    @if ($pendingCount > 0)
                        <span class="badge bg-warning rounded-pill me-1 position-relative">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                               {{ $pendingCount }}
                            </span>
                            Pending
                        </span> 
                    @endif
                    @if ($completedCount > 0)
                        <span class="badge bg-success rounded-pill me-1 position-relative">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $completedCount }}
                            </span>
                             Completed
                        </span>
                    @endif
                    @if ($pendingCount == 0 && $completedCount == 0)
                        <span class="badge bg-secondary rounded-pill me-1">No Status</span>
                    @endif
                    {{-- @php
                        $status = $child->vaccinationSchedules->status ?? null;
                    @endphp
                
                    @if ($status == 'completed')
                        <span class="badge bg-success rounded-pill me-1">Completed</span>
                    @elseif ($status == 'pending')
                        <span class="badge bg-warning rounded-pill me-1">Pending</span>
                    @else
                        <span class="badge bg-secondary rounded-pill me-1">No Status</span>
                    @endif --}}
    
                    </td>
                    <td>{{ $child->created_at->format('F j, Y') }}</td>
                    <td class="d-flex gap-2">                        
                        <a class="btn-primary btn-sm btn fs-4 text-white d-flex align-items-center justify-content-center" 
                        href="{{ route('child.edit', $child->id) }}"
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<i class='bx bx-edit' ></i> <span>Edit Child</span>"
                        >
                            <i class="bx bx-edit-alt"></i> 
                        </a>
                        <a class="btn btn-sm btn-danger fs-4 text-white d-flex align-items-center justify-content-center" 
                        href="{{ route('child.delete', $child->id) }}"
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<i class='bx bx-trash' ></i> <span>Delete Child</span>">
                            <i class="bx bx-trash"></i> 
                        </a>
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
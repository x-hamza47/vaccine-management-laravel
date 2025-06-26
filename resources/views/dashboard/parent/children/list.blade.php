@extends('dashboard.index')

@section('content')
<div class="card">
    <h5 class="card-header">All Child List</h5>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Child Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Vaccination Status</th>
            <th>Registered On</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            @if ($childs->isNotEmpty())
                @foreach ($childs as $child) 
                    <tr>
                    <td><strong>{{ $child->name }}</strong></td>
                    <td>{{ $child->dob }}</td>
                    <td>{{ ucfirst($child->gender) }}</td>
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
                        href="{{ route('parent.child.edit', $child->id) }}"
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<i class='bx bx-edit' ></i> <span>Edit Child</span>"
                        >
                            <i class="bx bx-edit-alt"></i> 
                        </a>
                        <a class="btn btn-sm btn-danger fs-4 text-white d-flex align-items-center justify-content-center" 
                        {{-- href="{{ route('parent.child.delete', $child->id) }}" --}}
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<i class='bx bx-trash' ></i> <span>Delete Child</span>">
                            <i class="bx bx-trash"></i> 
                        </a>
                    </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
      </table>
    </div>
  </div>
    
@endsection
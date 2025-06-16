@extends('dashboard.index')

@section('content')
<div class="card">

    <h5 class="card-header">All Child List</h5>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover table-dark">
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

            @if ($childs->isNotEmpty())
                @foreach ($childs as $child) 
                    <tr>
                    <td><strong>{{ $child->name }}</strong></td>
                    <td>{{ $child->dob }}</td>
                    <td>{{ $child->gender }}</td>
                    <td>{{ $child->user->name }}</td>
                    <td>
                    @php
                        $status = $child->vaccinationSchedules->status;
                    @endphp
                
                    @if ($status == 'completed')
                        <span class="badge bg-label-success me-1">Completed</span>
                    @elseif ($status == 'pending')
                        <span class="badge bg-label-warning me-1">Pending</span>
                    @else
                        <span class="badge bg-label-secondary me-1">No Status</span>
                    @endif
    
                    </td>
                    <td>{{ $child->created_at->format('F j, Y') }}</td>
                    <td>
                        <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('child.edit', $child->id) }}"
                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                            >
                            <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-trash me-1"></i> Delete</a
                            >
                        </div>
                        </div>
                    </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
      </table>
    </div>
  </div>
    
@endsection
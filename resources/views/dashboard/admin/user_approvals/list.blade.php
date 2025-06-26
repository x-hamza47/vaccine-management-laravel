@extends('dashboard.index')

@section('content')
<div class="card">

    <h5 class="card-header">All Approvals</h5>
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
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email Address</th>
            <th>Access Level</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

                @forelse ($users as $user) 
                    <tr>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td class="d-flex gap-2">   
                            {{--! Approve Button --}}
                    <form action="{{ route('user.approval.approve', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                    <button type="submit"                     
                        class="btn-primary btn-sm btn fs-4 text-white d-flex align-items-center justify-content-center" 
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title=" <span>Approve</span>"
                        >
                            <i class="bx bx-check"></i> 
                    </button>
                    </form>

                        {{--! Reject Button --}}
                    <form action="{{ route('user.approval.reject', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                         class="btn btn-sm btn-danger fs-4 text-white d-flex align-items-center justify-content-center" 
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<span>Reject</span>">
                            <i class="bx bx-x"></i> 
                        </button>
                    </form>
                    </td>
                    </tr>
                @empty
                <tr>
                  <td colspan="12" class="text-center text-muted p-3">No Request found.</td>
              </tr>
                @endforelse

        </tbody>
      </table>
    </div>
  </div>
    
@endsection
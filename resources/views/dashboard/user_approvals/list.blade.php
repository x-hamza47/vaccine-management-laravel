@extends('dashboard.index')

@section('content')
<div class="card">

    <h5 class="card-header">All Approvals</h5>
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

            @if ($users->isNotEmpty())
                @foreach ($users as $user) 
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
                        class="btn-success btn-sm btn fs-4 text-white d-flex align-items-center justify-content-center" 
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
                @endforeach
            @endif

        </tbody>
      </table>
    </div>
  </div>
    
@endsection
@extends('dashboard.index')

@section('content')
<div class="card">

    <h5 class="card-header">All Hospitals List</h5>
    <div class="d-flex">
      <form method="GET" class="row g-3 mb-4 px-4" action="{{ route('hospital.index') }}">
          <div class="col-auto">
              <input type="text" name="search" class="form-control" placeholder="Search hospital or location" value="{{ request('search') }}">
          </div>

          <div class="col-auto">
            <select name="sort_by" class="form-select">
                <option disabled selected>Sort By</option>
                <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                <option value="date" {{ request('sort_by') == 'date' ? 'selected' : '' }}>Date (Newest First)</option>
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
      <table class="table table-hover">
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

            @if ($hospitals->isNotEmpty())
                @foreach ($hospitals as $hospital) 
                    <tr>
                    <td><strong>{{ $hospital->hospital_name }}</strong></td>
                    <td
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<span>{{ $hospital->address }}</span>">
                        {{ $hospital->short_address }}
                    </td>
                    <td>{{ $hospital->location }}</td>
                    <td>{{ $hospital->user->email }}</td>
                    <td class="d-flex gap-2">                        
                        <a class="btn-primary btn-sm btn fs-4 text-white d-flex align-items-center justify-content-center" 
                        href="{{ route('hospital.edit', $hospital->id) }}"
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<i class='bx bx-edit' ></i> <span>Edit</span>"
                        >
                            <i class="bx bx-edit-alt"></i> 
                        </a>
                        <a class="btn btn-sm btn-danger fs-4 text-white d-flex align-items-center justify-content-center" 
                        href="{{ route('hospital.delete', $hospital->id) }}"
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="top"
                        data-bs-html="true"
                        title="<i class='bx bx-trash' ></i> <span>Delete</span>">
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
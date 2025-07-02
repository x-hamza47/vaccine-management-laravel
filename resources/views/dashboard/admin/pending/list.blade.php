@extends('dashboard.index')

@section('content')

    <div class="card text-bg-dark">
        <h5 class="card-header">All Approvals</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th>Child</th>
                        <th>Gender</th>
                        <th>Parent Name</th>
                        <th>Vaccine</th>
                        <th>Requested On</th>
                        <th>Hospital & Date</th>
                        <th>Approve/Reject</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @forelse ($vacc_req as $req)
                        <tr>
                            <td><strong>{{ $req->child->name }}</strong></td>
                            <td>{{ $req->gender }}</td>
                            <td>{{ $req->child->parent->name }}</td>
                            <td>{{ $req->vaccine->name }}</td>
                            <td>{{ $req->created_at->format('F j, Y') }}</td>
                            <td>
                                <form method="POST" id="approve-form-{{ $req->id }}"
                                    action="{{ route('child.approve.requests', $req->id) }}"
                                    class="d-flex gap-2 align-items-center">
                                    @csrf
                                    <select name="hospital_id"
                                        class="form-select form-select-sm @error('hospital_id') is-invalid @enderror">
                                        <option disabled selected>Select Hospital</option>
                                        @foreach ($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}" @selected($hospital->id == $req->hospital_id)>
                                                {{ $hospital->hospital_name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="date" name="date"
                                        class="form-control form-control-sm @error('date')is-invalid @enderror"
                                        value="{{ $req->preferred_date }}">
                                </form>
                            </td>
                            <td class="d-flex gap-2">
                                <button form="approve-form-{{ $req->id }}" class="btn btn-sm btn-success">
                                    Approve
                                </button>
                                <form method="POST" action="{{ route('child.reject.requests', $req->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">
                                        Reject
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">No pending vaccine requests found.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            <div class="mt-3 px-4">
                {{ $vacc_req->links() }}
            </div>
        </div>
    </div>

@endsection

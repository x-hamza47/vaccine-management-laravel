@extends('dashboard.index')


@section('content')
    <!-- Basic Layout -->
    <div>
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit Info</h5>
                <a href="{{ route('child.index') }}" class="btn btn-primary text-white">Go back</a>
                {{-- <small class="text-muted float-end">Default label</small> --}}
            </div>
            <div class="card-body">
                <form action="{{ route('child.update', $child->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="John Doe" name="name" value="{{ $child->name }}" />
                        </div>
                    </div>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="dob">Date of Birth</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="dob" placeholder="2025-02-12"
                                name="dob" value="{{ $child->dob }}" />
                                @error('dob')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- ? gender --}}
                    <div class="mb-3">
                        <label class="col-sm-2 col-form-label">Gender</label>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" @checked($child->gender == 'male')
                                 />
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female"
                            @checked($child->gender == 'female') />
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="other"
                            @checked($child->gender == 'other') />
                            <label class="form-check-label" for="inlineRadio3">Other</label>
                        </div>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- ?Status --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="status">Vaccination Status</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option selected disabled>Select status</option>
                                {{-- <option value="" @selected($child->vaccinationSchedules->status == null)>No Status</option> --}}
                                <option value="completed" @selected($child->vaccinationSchedules->status == 'completed')>Completed</option>
                                <option value="pending" @selected($child->vaccinationSchedules->status == 'pending')>Pending</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

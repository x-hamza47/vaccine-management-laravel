@extends('dashboard.index')


@section('content')
    <!-- Basic Layout -->
    <div>
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Add Child</h5>
                <a href="{{ route('child.index') }}" class="btn btn-primary text-white">Go back</a>
                {{-- <a href="{{ route('parent.child.index') }}" class="btn btn-primary text-white">Go back</a> --}}
                {{-- <small class="text-muted float-end">Default label</small> --}}
            </div>
            <div class="card-body">
                <form action="{{ route('child.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="basic-default-name" placeholder="John Doe" name="name" value="{{ old('name') }}" />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="dob">Date of Birth</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" placeholder="2025-02-12"
                                name="dob" value="{{ old('dob') }}"/>
                            @error('dob')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- ? gender --}}
                    <div class="mb-3">
                        <label class="col-sm-2 col-form-label">Gender</label>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="inlineRadio1" value="male" 
                            @checked(old('gender') == 'male')
                            />
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="inlineRadio2" value="female"
                            @checked(old('gender') == 'female')
                            />
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="inlineRadio3" value="other"
                            @checked(old('gender') == 'other')
                            />
                            <label class="form-check-label" for="inlineRadio3">Other</label>
                        </div>
                        {{-- @error('gender')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror --}}
                    </div>
            

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('dashboard.index')


@section('content')
    <!-- Basic Layout -->
    <div>
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Add Hospital</h5>
                <a href="{{ route('hospital.index') }}" class="btn btn-primary text-white">Go back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('hospital.store') }}" method="POST">
                    @csrf
                    {{-- ! username --}}
                    <h6 class="text-dark">1. Account Details</h6>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="name">Name</label>
                        <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="John Doe" name="name" value="{{ old('name') }}" />
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    {{-- ! email --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-email">Email Address</label>
                        <div class="col-sm-10">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="basic-default-email" placeholder="john@gmail.com" name="email" value="{{ old('email') }}" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    {{-- ! password --}}
                    <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="password">Password</label>
                            <div class="col-sm-10 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="basic-default-password"
                                    name="password"
                                    />
                                    <span class="input-group-text cursor-pointer" id="toggle-password"
                                      ><i class="bx bx-hide"></i
                                    ></span>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>
                            </div>
                    </div>
                    {{-- ! confirm password --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-password33">Confirm Password</label>
                        <div class="col-sm-10 form-password-toggle">
                            <div class="input-group input-group-merge">
                                <input
                                type="password"
                                class="form-control"
                                id="basic-default-password33"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="basic-default-password"
                                name="password_confirmation"
                                />
                                <span class="input-group-text cursor-pointer" id="basic-default-password"
                                ><i class="bx bx-hide"></i
                                ></span>

                            </div>
                        </div>
                    </div>

                    <hr class="divider my-4"/>
                    <h6 class="text-dark">2. Hospital Details</h6>   

                    {{-- ! Hospital Name --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Hospital Name</label>
                        <div class="col-sm-10">
                                <input type="text" class="form-control @error('hospital_name') is-invalid @enderror" id="basic-default-name" placeholder="e.g. Shifa Medical Center" name="hospital_name" value="{{ old('hospital_name') }}" />
                                @error('hospital_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                        </div>
                    </div>
                    {{-- ! address --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-address">Address</label>
                        <div class="col-sm-10">
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="basic-default-address" placeholder="e.g. 123 Main St, Johar Town" name="address" value="{{ old('address')}}" />
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                        </div>
                    </div>
                    {{-- ! location --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-location">Location</label>
                        <div class="col-sm-10">
                                <input type="text" class="form-control @error('location') is-invalid @enderror" id="basic-default-location" placeholder="e.g. Lahore, Karachi, Islamabad" name="location" value="{{ old('location') }}" />
                                @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                        </div>
                    </div>


                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Create Hospital</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

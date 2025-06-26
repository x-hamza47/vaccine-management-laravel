@extends('dashboard.index')


@section('content')
    <!-- Basic Layout -->
    <div>
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit Info</h5>
                <a href="{{ route('hospital.index') }}" class="btn btn-primary text-white">Go back</a>
                {{-- <small class="text-muted float-end">Default label</small> --}}
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- ! Name --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Hospital Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-name" placeholder="e.g. Shifa Medical Center" name="name" value="{{ $hospital->hospital_name }}" />
                        </div>
                    </div>
                    {{-- ! address --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-address">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-address" placeholder="e.g. 123 Main St, Johar Town" name="address" value="{{ $hospital->address }}" />
                        </div>
                    </div>
                    {{-- ! location --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-address">Location</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="basic-default-address" placeholder="e.g. Lahore, Karachi, Islamabad" name="address" value="{{ $hospital->location }}" />
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

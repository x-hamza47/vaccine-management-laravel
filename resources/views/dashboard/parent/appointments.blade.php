@extends('dashboard.index')


@section('content')
    <!-- Basic Layout -->
    <div>
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Book Appointment</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('parent.appointment.store') }}" method="POST">
                    @csrf
                    {{-- ?Select child --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="child_id">Child name</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('child_id') is-invalid @enderror" id="child_id" name="child_id">
                                <option selected disabled>--Select Child--</option>
                                @forelse ($childs as $child)
                                    <option value="{{ $child->id }}" >{{ $child->name }}</option>
                                @empty
                                    <span>No Child Found</span>
                                @endforelse
                            </select>
                            @error('child_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- ?Select vaccine --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="vaccine">Vaccine</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('vaccine') is-invalid @enderror" id="vaccine" name="vaccine">
                                <option selected disabled>Select Vaccine</option>
                                @forelse ($vaccines as $vaccine)
                                    <option value="{{ $vaccine->id }}" >{{ $vaccine->name }}</option>
                                @empty
                                    <span>No Vaccine Found</span>
                                @endforelse
                            </select>
                            @error('vaccine')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- ?Select hospital --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="hospital">Hospital</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('hospital') is-invalid @enderror" id="hospital" name="hospital">
                                <option selected disabled>Select Hospital</option>
                                @forelse ($hospitals as $hospital)
                                    <option value="{{ $hospital->id }}" >{{ $hospital->hospital_name }}</option>
                                    @empty
                                    <option disabled>No Hospital FOund</option>
                                    {{-- <span>No Hospital Found</span> --}}
                                @endforelse
                            </select>
                            @error('hospital')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="date">Preferred Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                                name="date" min="{{ now()->toDateString() }}" />
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Book Appointment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

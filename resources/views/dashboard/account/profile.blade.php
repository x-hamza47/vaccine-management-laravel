@extends('dashboard.index')

@section('content')
    <h4 class="fw-bold py-3 mb-4 text-white fw-light">Account Settings </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                {{-- <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ asset('dashboard-assets/assets/img/avatars/1.png') }}" alt="user-avatar"
                            class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" class="account-file-input" hidden
                                    accept="image/png, image/jpeg" />
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                    </div>
                </div> --}}
                <hr class="my-0" />
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('user.update',$user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Full Name</label>
                                <input class="form-control" type="text" id="firstName" name="name"
                                    value="{{ $user->name }}" autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email"
                                    value="{{ $user->email }}" placeholder="john.doe@example.com" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Access Level</label>
                                <input type="text" class="form-control text-capitalize" id="organization"
                                    value="{{ $user->role }}" @disabled(true)>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="date" class="form-label">Joined</label>
                                <input type="text" class="form-control text-capitalize" id="date"
                                    value="{{ $user->created_at->format('d M Y') }}" @disabled(true)>
                            </div>
                            {{-- ! Parents View --}}
                            @can('parent-view')
                               @include('dashboard.account.partials.parent_profile')
                            @endcan
                            {{-- ! Hospital View --}}
                            @can('hospital-view')
                                <div class="mb-3 col-md-6">
                                    <label for="hospital_name" class="form-label">Hospital name</label>
                                    <input type="text" class="form-control" id="hospital_name" name="hospital_name"
                                        placeholder="Hospital name" value="{{ $user->hospital->hospital_name }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Address" value="{{ $user->hospital->address }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="state" class="form-label">State</label>
                                    <input class="form-control" type="text" id="state" name="location"
                                        placeholder="California" value="{{ $user->hospital->location }}"/>
                                </div>
                            @endcan


                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <input type="reset" class="btn btn-outline-secondary" value="Cancel">
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
            <div class="card">
                <h5 class="card-header">Delete Account</h5>
                <div class="card-body">
                    <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                            <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                    </div>
                    <form id="formAccountDeactivation" method="POST" action="{{ route('user.destroy', Auth::id()) }}">
                        @csrf
                        @method('DELETE')
                    
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="confirm_delete" id="accountActivation"  />
                            <label class="form-check-label" for="accountActivation">
                                I confirm my account deactivation
                            </label>
                        </div>
                    
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account?');">
                            Delete My Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

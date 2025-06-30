                    <!-- Modal Backdrop -->
                    <div class="col-lg-4 col-md-3">
                        <div class="mt-3">
                            <!-- Modal -->
                            <div class="modal fade" id="editChildModal" data-bs-backdrop="static" tabindex="-1"
                                aria-labelledby="editChildModalLabel">
                                <div class="modal-dialog">
                                    <form method="POST" id="editChildForm" class="modal-content">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editChildModalLabel">Edit Child Info</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" id="editChildId">
                                            <div class="mb-3">
                                                <label for="editChildName" class="form-label">Name</label>
                                                <input type="text" name="name"
                                                    class="form-control  @error('name') is-invalid @enderror"
                                                    id="editChildName" value="{{ old('name') }}">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="editChildDob" class="form-label">Date of Birth</label>
                                                <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror"
                                                    id="editChildDob" value="{{ old('dob') }}">
                                                    @error('dob')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Gender</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="editMale" value="male" {{ old('gender') === 'male' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="editMale">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="editFemale" value="female" {{ old('female') === 'male' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="editFemale">Female</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="editOther" value="other" {{ old('other') === 'male' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="editOther">Other</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

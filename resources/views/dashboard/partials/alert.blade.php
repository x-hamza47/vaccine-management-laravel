@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed d-flex align-items-center" style="z-index: 9999;top:10%;right:5%;" role="alert">
      <i class="bx bx-check-circle me-2 fs-4"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show position-fixed d-flex align-items-center" style="z-index: 9999;top:10%;right:5%;" role="alert">
      <i class="bx bx-error-circle me-2 fs-4"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
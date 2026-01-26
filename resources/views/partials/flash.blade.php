@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" data-aos="fade-down">
        <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert" data-aos="fade-down">
        <i class="fa-solid fa-circle-info me-2"></i>{{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" data-aos="fade-down">
        <div class="fw-semibold mb-1"><i class="fa-solid fa-triangle-exclamation me-2"></i>Please fix the following:</div>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

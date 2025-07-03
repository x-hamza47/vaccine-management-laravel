<h5 class="my-3">Children</h5>

@if ($user->children->count())
    <div class="row">
        @foreach($user->children as $child)
        @php
            $completed = $child->vaccinationSchedules->where('status', 'completed')->count();
        @endphp
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-start border-4 border-primary">
                <div class="card-body">
                    <h5 class="card-title mb-1">{{ $child->name }}</h5>
                    <p class="mb-1">
                        <strong>Gender:</strong> {{ ucfirst($child->gender) }}
                    </p>
                    <p class="mb-1">
                        <strong>Vaccinations Completed:</strong>
                        {{ $completed }} 
                    </p>
                    <p class="text-muted mb-0">
                        <small>Added {{ $child->created_at->diffForHumans() }}</small>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@else
    <div class="alert alert-info">
        No children have been added yet.
    </div>
@endif
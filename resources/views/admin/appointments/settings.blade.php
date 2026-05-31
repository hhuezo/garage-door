@extends('menu')

@section('page_title', 'Appointments — Settings')

@push('styles')
    <link href="{{ asset('assets/libs/toast/toastr.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <h1 class="page-title fw-medium fs-18 mb-0">Appointments</h1>
            <p class="text-muted small mb-0">Configure daily limits and time slots. Public labels are generated from start time.</p>
        </div>
        <a href="{{ route('appointments.bookings.index') }}" class="btn btn-outline-primary btn-wave">View bookings</a>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof toastr !== 'undefined') toastr.success(@json(session('success')));
            });
        </script>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-3">
        <div class="col-xl-4">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title mb-0">Daily settings</div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('appointments.settings.update') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="daily_slots_limit">Daily slot limit</label>
                            <input type="number" class="form-control" id="daily_slots_limit" name="daily_slots_limit"
                                value="{{ old('daily_slots_limit', $settings->daily_slots_limit) }}" min="1" max="500" required>
                            <span class="form-text text-muted">Maximum appointments per day (all time slots combined).</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="booking_window_days">Booking window (days)</label>
                            <input type="number" class="form-control" id="booking_window_days" name="booking_window_days"
                                value="{{ old('booking_window_days', $settings->booking_window_days) }}" min="1" max="365" required>
                            <span class="form-text text-muted">How many days ahead customers can book.</span>
                        </div>
                        <button type="submit" class="btn btn-primary">Save settings</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between flex-wrap gap-2">
                    <div class="card-title mb-0">Time slots</div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create-slot">Add time slot</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-nowrap w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th>Time</th>
                                    <th class="text-center">Capacity</th>
                                    <th class="text-center">Order</th>
                                    <th class="text-center">Active</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($slots as $slot)
                                    @php
                                        $timeValue = \Illuminate\Support\Str::of((string) $slot->start_time)->substr(0, 5);
                                    @endphp
                                    <tr>
                                        <td class="fw-medium">{{ $slot->label_en }}</td>
                                        <td class="text-center">{{ $slot->capacity }}</td>
                                        <td class="text-center">{{ $slot->sort_order }}</td>
                                        <td class="text-center">
                                            @if ($slot->is_active)
                                                <span class="badge bg-success">Yes</span>
                                            @else
                                                <span class="badge bg-secondary">No</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-info btn-wave" data-bs-toggle="modal" data-bs-target="#modal-edit-slot-{{ $slot->id }}">Edit</button>
                                            <form method="post" action="{{ route('appointments.slots.destroy', $slot) }}" class="d-inline" onsubmit="return confirm('Delete this time slot?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-wave">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No time slots yet. Add one to enable booking on Contact Us.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($slots as $slot)
        @php
            $timeValue = \Illuminate\Support\Str::of((string) $slot->start_time)->substr(0, 5);
        @endphp
        <div class="modal fade" id="modal-edit-slot-{{ $slot->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ route('appointments.slots.update', $slot) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit time slot</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Start time</label>
                                <input type="time" class="form-control" name="start_time" value="{{ $timeValue }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Capacity</label>
                                <input type="number" class="form-control" name="capacity" value="{{ $slot->capacity }}" min="1" max="100" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sort order</label>
                                <input type="number" class="form-control" name="sort_order" value="{{ $slot->sort_order }}" min="0">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="edit-active-{{ $slot->id }}" @checked($slot->is_active)>
                                <label class="form-check-label" for="edit-active-{{ $slot->id }}">Active</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="modal-create-slot" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('appointments.slots.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add time slot</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Start time</label>
                            <input type="time" class="form-control" name="start_time" value="{{ old('start_time', '09:00') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Capacity</label>
                            <input type="number" class="form-control" name="capacity" value="{{ old('capacity', 2) }}" min="1" max="100" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sort order</label>
                            <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order') }}" min="0" placeholder="Auto">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="create-active" checked>
                            <label class="form-check-label" for="create-active">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/toast/toastr.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof expandMenuAndHighlightOption === 'function') {
                expandMenuAndHighlightOption(null, 'adminAppointments');
            }
        });
    </script>
@endpush

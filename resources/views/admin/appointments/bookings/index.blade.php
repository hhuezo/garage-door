@extends('menu')

@section('page_title', 'Appointments — Bookings')

@push('styles')
    <link href="{{ asset('assets/libs/dataTables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/toast/toastr.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <h1 class="page-title fw-medium fs-18 mb-0">Bookings</h1>
            <p class="text-muted small mb-0">Appointments scheduled from Contact Us.</p>
        </div>
        <a href="{{ route('appointments.settings') }}" class="btn btn-outline-primary btn-wave">Settings &amp; time slots</a>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof toastr !== 'undefined') toastr.success(@json(session('success')));
            });
        </script>
    @endif

    <div class="card custom-card mb-3">
        <div class="card-body">
            <form method="get" action="{{ route('appointments.bookings.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label" for="filter-from">From</label>
                    <input type="date" class="form-control" id="filter-from" name="from" value="{{ $from }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="filter-to">To</label>
                    <input type="date" class="form-control" id="filter-to" name="to" value="{{ $to }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('appointments.bookings.index') }}" class="btn btn-white">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card custom-card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable-bookings" class="table table-striped text-nowrap w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td data-order="{{ $booking->appointment_date?->format('Y-m-d') }}">{{ $booking->appointment_date?->format('m/d/Y') }}</td>
                                <td>{{ $booking->timeSlot?->label_en ?? '—' }}</td>
                                <td>{{ $booking->customer_name }}</td>
                                <td>{{ $booking->customer_phone ?: '—' }}</td>
                                <td>{{ $booking->customer_email }}</td>
                                <td>
                                    @if ($booking->status === 'pending')
                                        <span class="badge bg-success">Pending</span>
                                    @else
                                        <span class="badge bg-secondary">Cancelled</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($booking->status === 'pending')
                                        <form method="post" action="{{ route('appointments.bookings.cancel', $booking) }}" class="d-inline" onsubmit="return confirm('Cancel this appointment?');">
                                            @csrf
                                            @method('PATCH')
                                            @if ($from)<input type="hidden" name="from" value="{{ $from }}">@endif
                                            @if ($to)<input type="hidden" name="to" value="{{ $to }}">@endif
                                            <button type="submit" class="btn btn-sm btn-warning btn-wave">Cancel</button>
                                        </form>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No bookings yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/libs/toast/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dataTables/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof expandMenuAndHighlightOption === 'function') {
                expandMenuAndHighlightOption(null, 'adminAppointments');
            }
            if (typeof $ !== 'undefined' && $.fn.DataTable && document.querySelectorAll('#datatable-bookings tbody tr').length > 0) {
                $('#datatable-bookings').DataTable({
                    order: [[0, 'desc']],
                    pageLength: 25,
                });
            }
        });
    </script>
@endpush

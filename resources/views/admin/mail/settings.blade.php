@extends('menu')

@section('page_title', 'Mail — Settings')

@push('styles')
    <link href="{{ asset('assets/libs/toast/toastr.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <h1 class="page-title fw-medium fs-18 mb-0">Mail settings</h1>
            <p class="text-muted small mb-0">SMTP credentials and notification recipients used by contact and appointment emails.</p>
        </div>
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
        <div class="col-xl-6">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title mb-0">SMTP &amp; sender</div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('mail.settings.update') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="username">SMTP username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ old('username', $settings->username) }}" autocomplete="username">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">SMTP password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                value="" autocomplete="new-password"
                                placeholder="Leave blank to keep current password">
                            <span class="form-text text-muted">Leave blank if you do not want to change the stored password.</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="from_address">From address</label>
                            <input type="email" class="form-control" id="from_address" name="from_address"
                                value="{{ old('from_address', $settings->from_address) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="from_name">From name</label>
                            <input type="text" class="form-control" id="from_name" name="from_name"
                                value="{{ old('from_name', $settings->from_name) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="admin_to">Admin notification recipient</label>
                            <input type="email" class="form-control" id="admin_to" name="admin_to"
                                value="{{ old('admin_to', $settings->admin_to) }}">
                            <span class="form-text text-muted">Contact form and appointment notifications are sent here.</span>
                        </div>
                        <button type="submit" class="btn btn-primary">Save settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/toast/toastr.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof expandMenuAndHighlightOption === 'function') {
                expandMenuAndHighlightOption(null, 'adminMailSettings');
            }
        });
    </script>
@endpush

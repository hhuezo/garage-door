@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
            <div class="my-5 d-flex justify-content-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name') }}" class="desktop-logo" width="90" height="90">
                </a>
            </div>
            <div class="card custom-card">
                <div class="card-body p-5">
                    <p class="h5 fw-semibold mb-2 text-center">Sign In</p>
                    <p class="mb-4 text-muted op-7 fw-normal text-center">Admin panel</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <label for="email" class="form-label text-default">Email Address</label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="email@example.com"
                                    required
                                    autocomplete="email"
                                    autofocus
                                >
                                @error('email')
                                    <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="col-xl-12">
                                <label for="password" class="form-label text-default">Password</label>
                                <div class="input-group">
                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        placeholder="password"
                                        required
                                        autocomplete="current-password"
                                    >
                                    <button class="btn btn-light" type="button" onclick="createpassword('password', this)">
                                        <i class="ri-eye-off-line align-middle"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="col-xl-12 d-grid mt-2">
                                <button type="submit" class="btn btn-lg btn-primary">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

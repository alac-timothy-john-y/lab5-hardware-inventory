<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FinTrack Hardware Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-page d-flex align-items-center min-vh-100 py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="card login-card shadow-lg border-0">
                    <div class="card-header text-white text-center py-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white text-primary rounded-circle mb-2" style="width: 50px; height: 50px;">
                            <i class="bi bi-box-seam-fill fs-3" style="color: var(--theme-primary);"></i>
                        </div>
                        <h2 class="h3 fw-bold mb-1">FinTrack Hardware</h2>
                        <p class="mb-0 small text-light opacity-75">Inventory Management System</p>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger small py-2 mb-3">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold small">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                    <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" value="{{ old('email') }}" placeholder="admin@fintrack.local" required autofocus>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold small">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                                    <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" placeholder="Enter password" required>
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                <label class="form-check-label small" for="remember_me">Remember me</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Sign In</button>
                        </form>

                        <div class="mt-4 pt-3 border-top text-center">
                            <p class="small text-muted mb-1">Demo Credentials:</p>
                            <div class="badge bg-light text-dark border p-2 font-monospace">
                                admin@fintrack.local / 12345
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('register') }}" class="small text-decoration-none" style="color: var(--theme-secondary);">Create an account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
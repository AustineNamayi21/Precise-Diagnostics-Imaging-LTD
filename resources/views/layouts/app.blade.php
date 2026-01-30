<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name', 'Precise Diagnostics'))</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (optional but helps icons in auth pages if used) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        body {
            background: #f6f8fb;
            min-height: 100vh;
        }
        .auth-wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .auth-card {
            width: 100%;
            max-width: 520px;
            border: 0;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(16, 24, 40, .10);
            overflow: hidden;
            background: #fff;
        }
        .auth-top {
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            color: #fff;
            padding: 1.5rem 1.5rem;
        }
        .auth-top h1 {
            font-size: 1.2rem;
            margin: 0;
            font-weight: 700;
            letter-spacing: .2px;
        }
        .auth-top p {
            margin: .35rem 0 0;
            opacity: .9;
            font-size: .95rem;
        }
        .auth-body {
            padding: 1.5rem;
        }
        .form-control, .form-select {
            border-radius: 12px;
            padding: .75rem .95rem;
        }
        .btn-primary {
            border-radius: 12px;
            padding: .7rem 1rem;
            font-weight: 600;
        }
        .small-link a {
            text-decoration: none;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="auth-wrap">
        <div class="auth-card">
            <div class="auth-top">
                <h1>Precise Diagnostics Imaging</h1>
                <p>@yield('subtitle', 'Secure access to your account')</p>
            </div>

            <div class="auth-body">
                @if (session('status'))
                    <div class="alert alert-success mb-3">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>

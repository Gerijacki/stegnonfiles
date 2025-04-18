<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StegnonFiles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #e0e0e0;
            display: flex;
            flex-direction: column;
        }

        main.container {
            flex: 1 0 auto;
        }

        .bg-dark-custom {
            background-color: #1c1c1c !important;
        }

        .border,
        .shadow-sm {
            border-color: #333 !important;
            box-shadow: none !important;
        }

        .form-control,
        .btn,
        .alert {
            background-color: #222;
            color: #e0e0e0;
            border-color: #444;
        }

        .btn-primary {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        .btn-outline-primary {
            border-color: #4f46e5;
            color: #4f46e5;
        }

        .alert-secondary {
            background-color: #333;
            color: #ddd;
        }

        .navbar,
        footer.footer {
            flex-shrink: 0;
        }
    </style>
</head>

<body>

    <header class="navbar navbar-expand-lg navbar-dark bg-dark-custom shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">StegnonFiles</a>
            <div class="d-flex">
                <form method="GET" action="{{ route('lang.switch', 'ca') }}" class="d-inline">
                    <button type="submit" class="btn btn-link text-light">ca</button>
                </form>
                <form method="GET" action="{{ route('lang.switch', 'es') }}" class="d-inline">
                    <button type="submit" class="btn btn-link text-light">🇪🇸</button>
                </form>
                <form method="GET" action="{{ route('lang.switch', 'en') }}" class="d-inline">
                    <button type="submit" class="btn btn-link text-light">🇬🇧</button>
                </form>
            </div>
        </div>
    </header>

    <main class="container py-5">
        @yield('content')
    </main>

    <footer class="footer text-center py-3 text-light bg-dark-custom">
        © {{ date('Y') }} StegnonFiles — Privacidad sin cuentas. |
        <a href="https://www.gerardloriz.com" target="_blank" class="text-decoration-none text-light">Mi Portfolio</a>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

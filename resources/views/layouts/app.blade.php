<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Cadastro de produtos</title>
</head>
<body>
    <div class="container">
        <main role="main">
            @hasSection('body')
                @yield('body')
            @endif

        </main>
    </div>

<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

</body>
</html>

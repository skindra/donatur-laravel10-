<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    {{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
    <link rel="shortcut icon" href="img/icons/logo.jpg" />


    <title>{{ __('judul web') }}</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"> --}}
</head>

<body>

    <main class="d-flex w-100">
        <div class="container d-flex flex-column">

            @yield('content')

        </div>
    </main>
    <script src="/js/app.js"></script>
    {{-- <script src="/js/bootstrap.min.js"></script> --}}


</body>

</html>

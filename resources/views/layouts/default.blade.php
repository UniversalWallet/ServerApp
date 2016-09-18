<!DOCTYPE html>
<html lang="ru">
<head>
    @include('layouts.meta')

    <title>
        @section('title')
            PassBlock :
        @show
    </title>

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
    @include('layouts.navbar')

    <div class="container">
        @yield('content')
    </div>

    @include('layouts.footer')

    <script src="{{ asset('assets/js/app.js') }}"></script>
    @yield('script')
</body>
</html>

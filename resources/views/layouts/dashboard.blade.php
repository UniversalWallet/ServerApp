<!DOCTYPE html>
<html lang="ru">
<head>
    @include('layouts.meta')

    @section('meta')
    @show

    <title>
        @section('title')
            {{ config('app.name') }} :
        @show
    </title>

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
    @include('layouts.navbar')

    @include('layouts.modals')

    <div class="container p-b-25">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.messages')
                @yield('breadcrumb')
                @yield('content')
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="{{ asset('assets/js/app.js') }}"></script>
    @yield('script')
</body>
</html>

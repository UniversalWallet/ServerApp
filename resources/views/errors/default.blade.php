<!DOCTYPE html>
<html>
<head>
    @include('layouts.meta')

    <title>
        @section('title')
            {{ config('app.name') }}:
        @show
    </title>

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <style>
        html, body {
            height: 100%;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 300;
            line-height: 1.5;
        }
        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }
        .content {
            text-align: center;
            display: inline-block;
        }
        .error-title {
            font-weight: 300;
            font-size: 60px;
        }
        .error-subtitle {
            font-size: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="error-title">@yield('content-title')</div>
            <div class="error-subtitle">@yield('content-subtitle')</div>
        </div>
    </div>
</body>
</html>

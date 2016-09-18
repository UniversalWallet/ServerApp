@extends('layouts.back')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">

            @yield('panel-heading')

            <div class="clearfix"></div>
        </div>
        <div class="panel-body">

            @yield('panel-body')

        </div>
    </div>
@stop
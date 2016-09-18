@extends('errors.default')

@section('title')
    @parent Страница не найдена
@stop

@section('content-title', '404.')

@section('content-subtitle')
    Страница не найдена
    <div class="m-t-10">
        <a class="btn btn-default btn-sm" href="{{ route('front.home') }}">Главная страница</a>
    </div>
@stop

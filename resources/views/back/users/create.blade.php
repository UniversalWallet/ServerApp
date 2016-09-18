@extends('layouts.pages.createdit')

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', ['links' => [
        'Список пользователей' => route('back.users'),
        'Добавление пользователя' => ''
    ]])
@stop

@section('title')
    @parent Добавление пользователя
@stop

@section('fields')
    @include('back.users.fields')
@stop

@section('back-link')
    {{ route('back.users') }}
@stop




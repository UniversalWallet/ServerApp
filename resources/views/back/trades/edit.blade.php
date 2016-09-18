@extends('layouts.pages.createdit')

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', ['links' => [
        'Список торгов' => route('back.trades'),
        'Изменение торга' => ''
    ]])
@stop

@section('title')
    @parent Изменение торга
@stop

@section('fields')
    @include('back.trades.fields')
@stop

@section('after-form')
    @include('back.trades.lots-list', ['trade' => $item])
@stop

@section('back-link')
    {{ route('back.trades') }}
@stop

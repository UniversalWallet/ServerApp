@extends('layouts.pages.createdit')

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', ['links' => [
        'Список торгов' => route('back.trades'),
        'Торг' => route('back.trades.edit', $trade->id),
        'Добавление лота' => ''
    ]])
@stop

@section('title')
    @parent Добавление лота торга &laquo;{{ $trade->name }}&raquo;
@stop

@section('fields')
    @include('back.lots.fields')
@stop

@section('back-link')
    {{ route('back.trades.edit', $trade->id) }}
@stop




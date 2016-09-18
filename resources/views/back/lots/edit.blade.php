@extends('layouts.pages.createdit')

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', ['links' => [
        'Список торгов' => route('back.trades'),
        'Торг' => route('back.trades.edit', $item->trade->id),
        'Изменение лота' => ''
    ]])
@stop

@section('title')
    @parent Изменение лота торга &laquo;{{ $item->trade->name }}&raquo;
@stop

@section('fields')
    @include('back.lots.fields')
@stop

@section('back-link')
    {{ route('back.trades.edit', $item->trade->id) }}
@stop

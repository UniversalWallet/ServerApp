@extends('layouts.pages.createdit')

@section('title')
    @parent Покупка билета
@stop

@section('fields')
    @include('back.trades.fields')
@stop

@section('back-link')
    {{ '#' }}
@stop




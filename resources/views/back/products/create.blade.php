@extends('layouts.pages.createdit')

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', ['links' => [
        'Список продуктов' => route('back.products'),
        'Добавление продукта' => ''
    ]])
@stop

@section('title')
    @parent Добавление продукта
@stop

@section('fields')
    @include('back.products.fields')
@stop

@section('back-link')
    {{ route('back.products') }}
@stop




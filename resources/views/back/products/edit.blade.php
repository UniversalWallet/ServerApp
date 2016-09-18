@extends('layouts.pages.createdit')

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', ['links' => [
        'Список продуктов' => route('back.products'),
        'Изменение продукта' => ''
    ]])
@stop

@section('title')
    @parent Изменение продукта
@stop

@section('fields')
    @include('back.products.fields')
@stop

@section('back-link')
    {{ route('back.products') }}
@stop

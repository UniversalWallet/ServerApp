@extends('layouts.pages.index')

@section('title')
    @parent Список торгов
@stop

@section('content')
    <h5 class="light m-b-30 m-t-10 pull-left">Список торгов</h5>
    @include('layouts.partials.create-new-button', [
        'link' => route('create'),
        'name' => 'Добавить торг'
    ])
    <div class="clearfix"></div>
    @forelse($items as $item)
        @include('back.trades.trade-item', ['trade' => $item])
    @empty
        <span class="m-l-15 hint-text light fs-17">Пока нет торгов</span>
    @endforelse
@stop

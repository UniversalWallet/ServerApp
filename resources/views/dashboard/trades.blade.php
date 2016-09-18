@extends('layouts.dashboard')

@section('title')
    @parent Список торгов
@stop

@section('content')
    <h5 class="light m-b-30 m-t-10">Список торгов</h5>
    @forelse($trades as $trade)
        @include('dashboard.trade-item', ['trade' => $trade])
    @empty
        <span class="m-l-15 hint-text light fs-17">Пока нет торгов</span>
    @endforelse
@endsection

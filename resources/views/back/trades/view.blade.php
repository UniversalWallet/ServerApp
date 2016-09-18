@extends('layouts.pages.createdit')

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', ['links' => [
        'Список торгов' => route('back.trades'),
        'Просмотр торга' => ''
    ]])
@stop

@section('title')
    @parent Просмотр торга
@stop

@section('content')
    <div class="panel panel-{{ $item->trashed() ? 'warning' : ($item->is_visible ? ($item->is_completed ? 'info' : ($item->is_active ? 'success' : 'primary')) : 'default') }}">
        <div class="panel-heading">
            <span title="Номер торга" data-toggle="tooltip" class="light m-r-5 hint-text">#{{ $item->number }}</span>{{ $item->name }}
            <span title="Статус торга" data-toggle="tooltip" class="light m-l-10 hint-text pull-right">Торг {{ $item->trashed() ? 'архивирован' : ($item->is_visible ? ($item->is_completed ? 'завершён' : ($item->is_active ? 'идёт' : 'видим')) : 'скрыт') }}</span>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <strong class="col-sm-5">Валюта:</strong> <span class="col-sm-5">{{ $item->pretty_currency }}</span>
                    </div>
                    <div class="row">
                        <strong class="col-sm-5">Время пролонгации:</strong> <span class="col-sm-5">{{ $item->pretty_prolongation }}</span>
                    </div>
                    <div class="row">
                        <strong class="col-sm-5">Начало:</strong> <span class="col-sm-5">{{ $item->starts_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div class="row">
                        <strong class="col-sm-5">Окончание:</strong> <span class="col-sm-5">{{ $item->really_ends_at->format('d.m.Y H:i') }}</span>
                    </div>
                </div>
                <div class="col-md-5">
                    <strong>Описание:</strong><br />
                    {{ $item->description ? $item->description : '...' }}
                </div>
            </div>
        </div>
        @if($item->is_visible && $item->is_active)
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-2 text-center" style="line-height: 17px">
                        <div class="fs-11 light" style="margin-top: -6px">До&nbsp;окончания:</div>
                        <div class="fs-15"><strong class="trade-list-countdown" data-countdown-to="{{ $item->countdown_to }}" data-id="{{ $item->id }}"></strong></div>
                    </div>
                    <div class="col-sm-{{ $item->is_upcoming ? '8' : '10' }}">
                        <div class="progress progress-striped progress-bar-success active m-b-10 m-t-10">
                            <div class="progress-bar trade-list-progress-bar" data-id="{{ $item->id }}" style="width: {{ $item->completion_percent }}%"></div>
                        </div>
                    </div>
                    @if($item->is_upcoming)
                        <div class="col-sm-2 text-right">
                            <a href="{{ route('back.trades.edit', $item->id) }}" title="Изменение торга" class="btn btn-sm btn-primary">Изменить</a>
                        </div>
                    @endif
                </div>
                <div class="clearfix"></div>
            </div>
        @endif
    </div>
    <h5>Лоты</h5>
    @forelse($item->lots as $lot)
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-8">
                        <span title="Номер лота" data-toggle="tooltip" class="light m-r-5 fs-12">#{{ $lot->number }}</span>
                        <span @if($lot->comment) title="{{ str_limit($lot->comment, 300) }}" data-toggle="tooltip" @endif >{{ $lot->product ? str_limit($lot->product->name, 70) : '' }}</span>
                        <span title="Объём лота" data-toggle="tooltip" class="m-l-10 fs-12">{{ $lot->amount }}&nbsp;{{ $lot->unit }}</span>
                        <span title="Начальная цена и шаг цены" data-toggle="tooltip" class="light m-l-10 fs-12">{{ pretty_price($lot->price, $item->currency) }}&nbsp;(+{{ pretty_price($lot->step) }})</span>
                    </div>
                    <div class="col-md-4">
                        @if($item->is_active)
                            <form id="place_bid_form_{{ $lot->id }}" action="{{ route('back.lots.bid', $lot->id) }}" method="post" class="input-group">
                                {!! csrf_field() !!}
                                <input name="price" value="{{ $lot->next_bid }}" placeholder="Ставка" type="number" min="{{ $lot->next_bid }}" step="1" max="99999999" class="form-control input-sm" />
                                <span class="input-group-btn">
                                    <a data-form="place_bid_form_{{ $lot->id }}" data-toggle="modal" data-target="#modalConfirm" class="btn btn-sm btn-success" type="submit" href="#">Сделать ставку</a>
                                </span>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                @if(count($lot->bids) > 0)
                    <ul class="list-group m-t-5 m-b-0">
                        @foreach($lot->bids as $bid)
                            <li class="list-group-item">
                                <span title="Величина ставки" data-toggle="tooltip" class="">{{ pretty_price($bid->price, $item->currency) }}</span>
                                @include('layouts.partials.dd-delete-button', ['link' => route('back.lots.unbid', $bid->id), 'title' => 'Удалить ставку'])
                                @if($bid->bidded_by == 'admin')
                                    <span title="Администратор" data-toggle="tooltip" class="pull-right m-l-10 fs-12">{{ $bid->bidder->name }}</span>
                                @else
                                    <a href="{{ route('back.users.edit', $bid->bidder->id) }}" title="Пользователь" data-toggle="tooltip" class="pull-right m-l-10 fs-12">{{ $bid->bidder->name }}</a>
                                @endif
                                <span title="Дата и время ставки" data-toggle="tooltip" class="pull-right light m-l-10 fs-12">{{ $bid->created_at->format('d.m.Y H:i') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <span class="text-muted">Нет ставок</span>
                @endif
            </div>
        </div>
    @empty
        <span class="fs-15 m-l-10 light">Нет лотов</span>
    @endforelse
@stop

@section('back-link')
    {{ route('back.trades') }}
@stop

@section('meta')
    @if($item->is_active)
        <meta http-equiv="refresh" content="60">
    @endif
@stop
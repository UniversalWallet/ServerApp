<div class="panel panel-{{ ($trade->is_completed ? 'info' : ($trade->is_active ? 'success' : 'primary')) }}">
    <div class="panel-heading">
        <span title="Номер торга" data-toggle="tooltip" class="light m-r-5 hint-text">#{{ $trade->number }}</span>{{ $trade->name }}
        <span title="Статус торга" data-toggle="tooltip" class="light m-l-10 hint-text pull-right">Торг {{ $trade->trashed() ? 'архивирован' : ($trade->is_visible ? ($trade->is_completed ? 'завершён' : ($trade->is_active ? 'идёт' : 'видим')) : 'скрыт') }}</span>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div class="row m-b">
            <div class="col-sm-7">
                <div class="row">
                    <strong class="col-sm-5">Валюта:</strong> <span class="col-sm-5">{{ $trade->pretty_currency }}</span><br />
                </div>
                <div class="row">
                    <strong class="col-sm-5">Время пролонгации:</strong> <span class="col-sm-5">{{ $trade->pretty_prolongation }}</span><br />
                </div>
                <div class="row">
                    <strong class="col-sm-5">Начало:</strong> <span class="col-sm-5">{{ $trade->starts_at->format('d.m.Y H:i') }}</span><br />
                </div>
                <div class="row">
                    <strong class="col-sm-5">Окончание:</strong> <span class="col-sm-5">{{ $trade->really_ends_at->format('d.m.Y H:i') }}</span>
                </div>
            </div>
            <div class="col-sm-5">
                <strong>Описание:</strong><br />
                {!! $trade->description ? $trade->description : '...' !!}
            </div>
        </div>
        <hr class="m-b-5 m-t-5" />
        <strong>Лоты:</strong><br />
        @if(count($trade->lots) > 0)
            <ul class="list-group m-t-5 m-b-0">
                @foreach($trade->lots as $lot)
                    <li class="list-group-item p-t-5 p-b-5">
                        @if($trade->is_active)
                            <strong title="Текущая цена" data-toggle="tooltip" class="m-l-5 fs-14 pull-right">{{ pretty_price($lot->current_price, $trade->currency) }}</strong>
                        @endif
                        <span title="Номер лота" data-toggle="tooltip" class="light m-r-5 fs-12">#{{ $lot->number }}</span>
                        <span @if($lot->comment) title="{{ str_limit($lot->comment, 300) }}" data-toggle="tooltip" @endif >{{ $lot->product ? str_limit($lot->product->name, 70) : '' }}</span>
                            <span title="Объём лота" data-toggle="tooltip" class="m-l-10 fs-12">{{ $lot->amount }}&nbsp;{{ $lot->unit }}</span>
                        <span title="Начальная цена и шаг цены" data-toggle="tooltip" class="light m-l-10 fs-12">{{ pretty_price($lot->price, $trade->currency) }}&nbsp;(+{{ pretty_price($lot->step) }})</span>
                    </li>
                @endforeach
            </ul>
        @else
            <span class="fs-15 m-l-10 light">Нет лотов</span>
        @endif
    </div>
    @if($trade->is_active)
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-2 text-center" style="line-height: 17px">
                    <div class="fs-11 light" style="margin-top: -6px">До&nbsp;окончания:</div>
                    <div class="fs-15"><strong class="trade-list-countdown" data-countdown-to="{{ $trade->countdown_to }}" data-id="{{ $trade->id }}"></strong></div>
                </div>
                <div class="col-sm-8">
                    <div class="progress progress-striped progress-bar-success active m-b-10 m-t-10">
                        <div class="progress-bar trade-list-progress-bar" data-id="{{ $trade->id }}" style="width: {{ $trade->completion_percent }}%"></div>
                    </div>
                </div>
                <div class="col-sm-2 text-right">
                    <a href="{{ route('dashboard.trades.view', $trade->id) }}" title="Просмотр лота" class="btn btn-sm btn-primary">Просмотр</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    @endif
</div>
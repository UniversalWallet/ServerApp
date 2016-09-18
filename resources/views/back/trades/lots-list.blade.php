<div class="clearfix m-b-20"></div>

<div class="panel panel-default">
    <div class="panel-heading">
        Лоты
        <a href="{{ route('back.lots.create', $trade->id) }}" title="Добавить лот" class="btn btn-sm btn-success pull-right">Добавить лот</a>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        @if(count($trade->lots) > 0)
            <ul class="list-group m-t-0 m-b-0 sortable" data-entity="lots" data-action="{{ route('back.service.sort') }}">
                @foreach($trade->lots as $lot)
                    <li class="list-group-item" data-item-id="{{ $lot->id }}">
                        <span class="list-group-handler"><i class="fa fa-bars"></i></span>
                        <span title="Номер лота" data-toggle="tooltip" class="light m-r-5 fs-12">#{{ $lot->number }}</span>
                        <span @if($lot->comment) title="{{ str_limit($lot->comment, 300) }}" data-toggle="tooltip" @endif >{{ $lot->product ? str_limit($lot->product->name, 70) : '' }}</span>
                        <span title="Объём лота" data-toggle="tooltip" class="m-l-10 fs-12">{{ $lot->amount }}&nbsp;{{ $lot->unit }}</span>
                        <span title="Начальная цена и шаг цены" data-toggle="tooltip" class="light m-l-10 fs-12">{{ pretty_price($lot->price, $trade->currency) }}&nbsp;(+{{ pretty_price($lot->step) }})</span>
                        @include('layouts.partials.dd-delete-button', ['link' => route('back.lots.delete', $lot->id), 'title' => 'Удалить лот'])
                        @include('layouts.partials.dd-edit-button', ['link' => route('back.lots.edit', $lot->id), 'title' => 'Редактировать лот'])
                    </li>
                @endforeach
            </ul>
        @else
            <span class="text-muted">Нет лотов</span>
        @endif
    </div>
</div>

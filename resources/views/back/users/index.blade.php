@extends('layouts.pages.index')

@section('title')
    @parent Список пользователей
@stop

@section('panel-heading')
    <div class="pull-left">
        Список пользователей
    </div>
    @include('layouts.partials.create-new-button', [
        'link' => route('back.users.create'),
        'name' => 'Добавить пользователя'
    ])
@stop

@section('panel-body')
    @if(count($items) > 0)
        <table class="table table-hover no-footer" cellspacing="0">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Контакты</th>
                <th>Зарегистрирован</th>
                <th>Компания</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                            {{ $item->name }}
                        </td>
                        <td>
                            <a href="mailto:{{$item->email}}">{{ $item->email }}</a><br />
                            {{$item->phone}}
                        </td>
                        <td>
                            {{ $item->created_at->format('d.m.Y H:i') }}
                        </td>
                        <td>
                            <strong class="fs-11">Название: </strong><br />{{ $item->company_name or '—' }} <br />
                            <strong class="fs-11">Должность: </strong><br />{{ $item->company_position or '—' }} <br />
                            <strong class="fs-11">ИНН: </strong><br />{{ $item->company_inn or '—' }}
                        </td>
                        <td>
                            @if($item->is_confirmed)
                                <span class="label label-success">Подтверждён</span>
                            @else
                                <span class="label label-warning">Не подтверждён</span>
                            @endif
                        </td>
                        <td>
                            @include('layouts.partials.table-edit-button', [
                                'link' => route('back.users.edit', $item->id), 'name' => 'Изменить'
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <span class="text-muted">Пока нет пользователей</span>
    @endif
@stop

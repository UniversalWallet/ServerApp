@extends('layouts.pages.index')

@section('title')
    @parent Список продуктов
@stop

@section('panel-heading')
    Список продуктов
    @include('layouts.partials.create-new-button', [
        'link' => route('back.products.create'),
        'name' => 'Добавить продукт'
    ])
@stop

@section('panel-body')
    @if(count($items) > 0)
        <table class="table table-hover no-footer" cellspacing="0">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                            {{ $item->name }}<br />
                        </td>
                        <td>
                            @include('layouts.partials.table-edit-button', [
                                'link' => route('back.products.edit', $item->id), 'name' => 'Изменить'
                            ])
                            @include('layouts.partials.table-delete-button', [
                                'link' => route('back.products.delete', $item->id), 'name' => 'Удалить'
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <span class="text-muted">Пока нет продуктов</span>
    @endif
@stop

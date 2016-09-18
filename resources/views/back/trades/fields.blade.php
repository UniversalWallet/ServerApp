
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">{{ isset($item) ? "Изменение торга" : "Покупка билета" }}</div>
    </div>
    <div class="panel-body">
        @include('layouts.partials.form.input-text', [
            'name' => 'address',
            'title' => 'Кошелёк',
            'required' => true,
            'value' => old('event_name', isset($item) ? $item->name : ''),
            'placeholder' => 'Введите кошелёк'
        ])
        @include('layouts.partials.form.input-text', [
            'name' => 'event',
            'title' => 'Мероприятие',
            'required' => true,
            'value' => old('event_name', isset($item) ? $item->name : ''),
            'placeholder' => 'Введите название мероприятия'
        ])
        @include('layouts.partials.form.input-text', [
            'name' => 'place',
            'title' => 'Место проведение',
            'required' => true,
            'value' => old('description', isset($item) ? $item->description : ''),
            'placeholder' => 'Введите место проведения'
        ])
        @include('layouts.partials.form.input-text', [
           'name' => 'seat',
           'title' => 'Посадочное место',
           'required' => true,
           'value' => old('description', isset($item) ? $item->description : ''),
           'placeholder' => 'Введите посадочное место'
       ])
        @include('layouts.partials.form.input-text', [
           'name' => 'price',
           'title' => 'Цена',
           'required' => true,
           'value' => old('description', isset($item) ? $item->description : ''),
           'placeholder' => 'Введите цену'
       ])
        @include('layouts.partials.form.input-text', [
           'name' => 'vendor_id',
           'title' => 'Номер билета',
           'required' => true,
           'value' => old('description', isset($item) ? $item->description : ''),
           'placeholder' => 'Введите номер билета'
       ])

        @include('layouts.partials.form.select', [
           'title' => 'Партнёр',
           'name' => 'partner_id',
           'selected' => old('prolongation', isset($item) ? $item->prolongation : ''),
           'options' => [
               1  => 'РЖД',
               2 => 'Лужники',
               3 => 'Аэрофлот',
               4 => 'КАРО Фильм',
           ]
       ])

        @include('layouts.partials.form.datetime', [
            'title' => 'Время проведения',
            'name' => 'time_at',
            'required' => true,
            'value' => old('deadline_at', isset($item) ? ($item->deadline_at ? $item->deadline_at->format('d.m.Y H:i') : '') : ''),
            'placeholder' => 'Выберите дату и время (необязательно)'
        ])

    </div>
</div>
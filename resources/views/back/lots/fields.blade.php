
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">{{ isset($item) ? "Изменение лота" : "Добавление лота" }} торга &laquo;{{ isset($item) ? $item->trade->name : $trade->name }}&raquo;</div>
    </div>
    <div class="panel-body">
        @include('layouts.partials.form.select', [
            'title' => 'Товар',
            'name' => 'product_id',
            'required' => true,
            'selected' => old('product_id', isset($item) ? $item->product_id : 0),
            'options' => $products->pluck('name', 'id')->toArray()
        ])
        @include('layouts.partials.form.input-textarea', [
            'name' => 'comment',
            'title' => 'Комментарий',
            'required' => false,
            'value' => old('comment', isset($item) ? $item->comment : ''),
            'placeholder' => 'Введите комментарий'
        ])
        @include('layouts.partials.form.input-number', [
            'name' => 'price',
            'title' => 'Начальная цена',
            'required' => true,
            'min' => 0,
            'value' => old('price', isset($item) ? $item->price : ''),
            'placeholder' => 'Введите цену ('.currency_symbol(isset($item) ? $item->trade->currency : $trade->currency).')'
        ])
        @include('layouts.partials.form.input-number', [
            'name' => 'step',
            'title' => 'Минимальный шаг цены',
            'required' => true,
            'min' => 0,
            'value' => old('step', isset($item) ? $item->step : ''),
            'placeholder' => 'Введите шаг цены ('.currency_symbol(isset($item) ? $item->trade->currency : $trade->currency).')'
        ])
        @include('layouts.partials.form.input-number', [
            'name' => 'amount',
            'title' => 'Объём',
            'required' => true,
            'min' => 0,
            'value' => old('amount', isset($item) ? $item->amount : ''),
            'placeholder' => 'Введите объём'
        ])
        @include('layouts.partials.form.input-text', [
            'name' => 'unit',
            'title' => 'Единица измерения',
            'required' => true,
            'value' => old('unit', isset($item) ? $item->unit : ''),
            'placeholder' => 'Введите единицу измерения'
        ])
    </div>
</div>
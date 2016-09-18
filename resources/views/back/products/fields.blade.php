<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">{{ isset($item) ? "Изменение продукта" : "Добавление продукта" }}</div>
    </div>
    <div class="panel-body">
        @include('layouts.partials.form.input-text', [
            'name' => 'name',
            'title' => 'Название',
            'required' => true,
            'value' => old('name', isset($item) ? $item->name : ''),
            'placeholder' => 'Введите название продукта'
        ])
        @include('layouts.partials.form.input-textarea', [
            'name' => 'description',
            'title' => 'Описание',
            'value' => old('description', isset($item) ? $item->description : ''),
            'placeholder' => 'Введите описание продукта'
        ])
    </div>
</div>
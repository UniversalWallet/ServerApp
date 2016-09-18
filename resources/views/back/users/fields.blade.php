<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">{{ isset($item) ? "Изменение пользователя" : "Добавление пользователя" }}</div>
    </div>
    <div class="panel-body">
        @include('layouts.partials.form.input-text',[
                           'name' => 'email',
                           'title' => 'E-Mail',
                           'required' => true,
                           'type' => 'email',
                           'value' => old('email', isset($item) ? $item->email : ''),
                           'placeholder' => 'Введите ваш рабочий email'
                       ])

        @include('layouts.partials.form.input-text',[
                            'name' => 'name',
                            'title' => 'ФИО',
                            'required' => true,
                            'value' => old('name', isset($item) ? $item->name : ''),
                            'placeholder' => 'Введите ваши фамилию, имя и отчество'
        ])

        @include('layouts.partials.form.input-text',[
                            'name' => 'phone',
                            'title' => 'Рабочий телефон',
                            'required' => true,
                            'value' => old('phone', isset($item) ? $item->phone : ''),
                            'placeholder' => 'Введите ваш рабочий телефон для связи'
        ])

        @include('layouts.partials.form.input-text',[
                            'name' => 'company_name',
                            'title' => 'Название компании',
                            'required' => true,
                            'value' => old('company_name', isset($item) ? $item->company_name : ''),
                            'placeholder' => 'Введите полное название вашей компании'
        ])

        @include('layouts.partials.form.input-text',[
                            'name' => 'company_position',
                            'title' => 'Должность',
                            'required' => true,
                            'value' => old('company_position', isset($item) ? $item->company_position : ''),
                            'placeholder' => 'Введите занимаемую вами должность'
        ])

        @include('layouts.partials.form.input-text',[
                            'name' => 'company_inn',
                            'title' => 'ИНН',
                            'required' => true,
                            'value' => old('company_inn', isset($item) ? $item->company_inn : ''),
                            'placeholder' => 'Введите ИНН компании'
        ])
        @include('layouts.partials.form.checkbox', [
                             'title' => 'Подтверждён',
                             'name' => 'is_confirmed',
                             'checked' => old('is_confirmed', isset($item) ? $item->is_confirmed : 0)
        ])
    </div>
</div>
@extends('layouts.default')

@section('title')
    @parent Регистрация
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Регистрация</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('auth.register.perform') }}">
                        {{ csrf_field() }}

                        @include('layouts.partials.form.input-text',[
                            'name' => 'email',
                            'title' => 'E-Mail',
                            'required' => true,
                            'type' => 'email',
                            'value' => old('email'),
                            'placeholder' => 'Введите ваш рабочий email'
                        ])

                        @include('layouts.partials.form.input-text',[
                           'name' => 'password',
                           'title' => 'Пароль',
                           'required' => true,
                           'type' => 'password',
                           'placeholder' => 'Введите пароль'
                        ])

                        @include('layouts.partials.form.input-text',[
                          'name' => 'password_confirmation',
                          'title' => 'Подтверждение пароля',
                          'required' => true,
                          'type' => 'password',
                          'placeholder' => 'Введите пароль ещё раз'
                        ])

                        @include('layouts.partials.form.input-text',[
                            'name' => 'name',
                            'title' => 'ФИО',
                            'required' => true,
                            'value' => old('name'),
                            'placeholder' => 'Введите ваши фамилию, имя и отчество'
                        ])

                        @include('layouts.partials.form.input-text',[
                            'name' => 'phone',
                            'title' => 'Рабочий телефон',
                            'required' => true,
                            'value' => old('phone'),
                            'placeholder' => 'Введите ваш рабочий телефон для связи'
                        ])

                        @include('layouts.partials.form.input-text',[
                            'name' => 'company_name',
                            'title' => 'Название компании',
                            'required' => true,
                            'value' => old('company_name'),
                            'placeholder' => 'Введите полное название вашей компании'
                        ])

                        @include('layouts.partials.form.input-text',[
                            'name' => 'company_position',
                            'title' => 'Должность',
                            'required' => true,
                            'value' => old('company_position'),
                            'placeholder' => 'Введите занимаемую вами должность'
                        ])

                        @include('layouts.partials.form.input-text',[
                            'name' => 'company_inn',
                            'title' => 'ИНН',
                            'required' => true,
                            'value' => old('company_inn'),
                            'placeholder' => 'Введите ИНН компании'
                        ])

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Зарегистрироваться
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

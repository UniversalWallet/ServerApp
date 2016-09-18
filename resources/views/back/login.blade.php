@extends('layouts.default')

@section('title')
    @parent Вход
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Вход</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="post" action="{{ route('back.login.perform') }}">
                            {{ csrf_field() }}

                            @include('layouts.partials.form.input-text',[
                               'name' => 'email',
                               'title' => 'E-Mail',
                               'required' => true,
                               'type' => 'email',
                               'autofocus' => true,
                               'placeholder' => 'Введите ваш логин',
                               'value' => old('email')
                            ])

                            @include('layouts.partials.form.input-text',[
                               'name' => 'password',
                               'title' => 'Пароль',
                               'required' => true,
                               'type' => 'password',
                               'placeholder' => 'Введите ваш пароль'
                            ])
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-9 col-md-offset-3 p-l-20">
                                        <div class="checkbox m-l-5">
                                            <label>
                                                <input type="checkbox" name="remember" value="1"> Запомнить меня
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary m-t-20">Войти</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

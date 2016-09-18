@extends('layouts.default')

@section('title')
    @parent Вход
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Вход</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        @include('layouts.partials.form.input-text',[
                           'name' => 'email',
                           'title' => 'E-Mail',
                           'required' => true,
                           'type' => 'email',
                           'autofocus' => true,
                           'value' => old('email'),
                           'placeholder' => 'Введите ваш логин'
                       ])

                        @include('layouts.partials.form.input-text',[
                           'name' => 'password',
                           'title' => 'Пароль',
                           'required' => true,
                           'type' => 'password',
                           'placeholder' => 'Введите ваш пароль'
                       ])

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" value="1"> Запомнить меня
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Войти
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Забыль пароль?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

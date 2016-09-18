@extends('layouts.dashboard')

@section('title')
    @parent Аккаунт не подтверждён
@stop

@section('content')
    {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading">Активация</div>--}}

        {{--<div class="panel-body">--}}
            {{--<h3>Ваш аккаунт ещё не подтверждён</h3>--}}
            {{--<p>Дождитесь подтверждения аккаунта или свяжитесь с администрацией</p>--}}
        {{--</div>--}}
    {{--</div>--}}

    @include('layouts.partials.message-warning', [
        'message' => '<h4>Ваш аккаунт ещё не подтверждён</h4><p>Дождитесь подтверждения аккаунта или свяжитесь с администрацией</p>',
        'disappear' => false
    ])

    <div class="panel panel-default">
        <div class="panel-heading">Обратная связь</div>

        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('dashboard.feedback') }}">
                {{ csrf_field() }}

                @include('layouts.partials.form.input-textarea',[
                   'name' => 'message',
                   'title' => 'Сообщение администратору',
                   'required' => true
               ])

                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">
                            Отправить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

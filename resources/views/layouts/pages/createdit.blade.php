@extends('layouts.back')

@section('content')
    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}

        @yield('fields')

        <div class="clearfix"></div>
        <div class="pull-left">
            <input type="submit" class="btn btn-success inline m-b-5 m-r-5" value="Подтвердить" />
        </div>
    </form>

    @yield('after-form')
@stop


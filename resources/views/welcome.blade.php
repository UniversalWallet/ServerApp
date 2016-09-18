@extends('layouts.default')

@section('title')
    @parent Главная
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-sm-6">
                        <h1>Universal Wallet</h1>
                        <p class="lead">Реест билетов на платформе Ethereum</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="landing-buttons m-l-15">
                    <a href="{{route('front.buy')}}" class="btn btn-default">Демо покупка</a>
                    <a href="mailto:{{'v.koleoshkin@gmail.com'}}" class="btn btn-default">Связаться</a>
                </div>
            </div>
        </div>
    </div>
@endsection

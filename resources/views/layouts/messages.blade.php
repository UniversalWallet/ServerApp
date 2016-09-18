@if(session()->has('errors'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        @include('layouts.partials.alert-close-button')
        <ul class="l-s-n p-l-0">
            @foreach(session('errors')->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        @include('layouts.partials.alert-close-button')
        <span>{!! session('success') !!}</span>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        @include('layouts.partials.alert-close-button')
        <span>{!! session('error') !!}</span>
    </div>
@endif

@if(session()->has('warning'))
    @include('layouts.partials.message-warning', ['message' => session('warning')])
@endif
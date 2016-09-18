<div class="alert alert-warning {{ isset($disappear) && ! $disappear ? 'do-not-disappear' : '' }} alert-dismissible" role="alert">
    @include('layouts.partials.alert-close-button')
    {!! $message or '' !!}
</div>
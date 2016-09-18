@if(isset($disabled) && $disabled)
    <button class="btn btn-{{ $buttonColor or 'primary' }} btn-sm inline m-b-5 m-r-5" disabled>{!! $name or 'Изменить' !!}</button>
@else
    <a href="{{ $link or '#' }}" class="btn btn-{{ $buttonColor or 'primary' }} btn-sm inline m-b-5 m-r-5">{!! $name or 'Изменить' !!}</a>
@endif
{{--<i class="fa {{ $iconClass or 'fa-pencil' }} fa-fw"></i>--}}
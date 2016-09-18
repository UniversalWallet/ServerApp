<ul class="breadcrumb">
    @foreach($links as $name => $link)
        <li>
            @if($loop->last)
                {!! $name !!}
            @else
                <a href="{{ $link }}" class="active no-margin">{!! $name !!}</a>
            @endif
        </li>
    @endforeach
</ul>
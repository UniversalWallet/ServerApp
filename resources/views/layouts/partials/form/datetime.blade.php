<div class="form-group {{ isset($required) && $required ? 'required' : '' }}">
    <label class="col-md-3 control-label" for="input_{{ $name or '' }}">{!! $title or '' !!}</label>
    <div class="input-group col-md-9 p-l-15">
        <input id="input_{{ $name or '' }}" name="{{ $name or '' }}" value="{{ $value or '' }}" type="@yield('type')" class="form-control datetimepicker" placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required' : '' }} />
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
</div>
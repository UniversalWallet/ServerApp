<div class="form-group {{ $errors->has(isset($name) ? $name : '') ? ' has-error' : '' }} {{ isset($required) && $required ? 'required': ''}}">
    <label for="input_{{ $name or '' }}" class="col-md-3 control-label">{!! $title or '' !!}</label>

    <div class="col-md-9">
        <textarea id="input_{{ $name or '' }}" class="form-control" name="{{ $name }}" placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required': '' }} {{ isset($autofocus) && $autofocus ? 'autofocus' : '' }}>{{ $value or '' }}</textarea>

        @if($errors->has(isset($name) ? $name : ''))
            <span class="help-block">
                <strong>{{ $errors->first(isset($name) ? $name : '') }}</strong>
            </span>
        @endif
    </div>
</div>
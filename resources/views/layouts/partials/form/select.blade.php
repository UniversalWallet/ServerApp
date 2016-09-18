<div class="form-group {{ $errors->has(isset($name) ? $name : '') ? ' has-error' : '' }} {{ isset($required) && $required ? 'required': ''}}">
    <label for="input_{{ $name or '' }}" class="col-md-3 control-label">{!! $title or '' !!}</label>

    <div class="col-md-9">
        <select name="{{ $name or '' }}" class="form-control" id="input_{{ $name or '' }}">
            @if(isset($options) && is_array($options))
                @foreach($options as $optValue => $optName)
                    <option value="{{ $optValue }}" {{ (isset($selected) ? $selected : '') == $optValue ? 'selected' : '' }}>{{ $optName }}</option>
                @endforeach
            @endif
        </select>

        @if($errors->has(isset($name) ? $name : ''))
            <span class="help-block">
                <strong>{{ $errors->first(isset($name) ? $name : '') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group">
    <div class="col-md-9 col-md-offset-3">
        <div class="checkbox">
            <label>
                <input name="{{ $name or '' }}" type="checkbox" value="1" {{ isset($checked) && $checked ? 'checked' : '' }} /> {{ $title or '' }}
            </label>
        </div>
    </div>
</div>
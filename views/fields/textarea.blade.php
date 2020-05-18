<div class="form-group {{ $errors->has($name) ? 'is-invalid' : ''}}">
    {{ Form::label($name, __($label ?: $name)) }}
    {{ Form::textarea($name, $value, array_merge(['class' => 'form-control '], $attributes)) }}
    <div class="invalid-feedback">
        {{ $errors->first($name) }}
    </div>
</div>
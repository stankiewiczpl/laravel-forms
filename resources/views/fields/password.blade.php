<div class="form-group {{ $errors->has($name) ? 'is-invalid' : ''}}">
    {{ Form::label($name, __($label ?: $name)) }}
    {{ Form::password($name, array_merge(['class' => 'form-control '], $attributes)) }}
    <div class="invalid-feedback">
        {{ $errors->first($name) }}
    </div>
</div>
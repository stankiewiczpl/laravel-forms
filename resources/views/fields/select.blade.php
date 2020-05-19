<div class="form-group {{ $errors->has($name) ? 'is-invalid' : ''}}">
    {{ Form::label($name, __($label ?: $name)) }}
    {{ Form::select($name,$options, $value, array_merge(['class' => 'form-control '.($errors->first($name) ?'is-invalid': ''),'id'=>$name], $attributes)) }}
    <div class="invalid-feedback">
        {{ $errors->first($name) }}
    </div>
</div>
<?php

if (!function_exists('transform_key')) {
    function transform_key($key)
    {
        return str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $key);
    }
}

if (!function_exists('translatable_input_name')) {
    function translatable_input_name($name)
    {
        $lang = request()->input('lang', app()->getLocale());
        return $name.':'.$lang;
    }
}

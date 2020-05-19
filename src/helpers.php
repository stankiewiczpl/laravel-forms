<?php

if (!function_exists('transform_key')) {
    function transform_key($key)
    {
        return str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $key);
    }
}

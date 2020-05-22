<?php

namespace Stankiewiczpl\Laravelforms\Rules;

use EditorJS\EditorJSException;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class EditorJs implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->validate($attribute, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('The :attribute is invalid');
    }

    public function validate($attribute, $value)
    {
        try {
            $config = json_encode(config('laravel-forms.editorjs.render'));
            new \EditorJS\EditorJS($value, $config);
            return true;
        } catch (EditorJSException $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}

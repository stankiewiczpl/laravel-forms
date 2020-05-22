<?php

namespace Stankiewiczpl\LaravelForms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class Gallery extends FormField
{
    protected function getTemplate()
    {
        return 'forms::fields.gallery';
    }

    public function getDefaultValue($default = null)
    {
        return $this->parent->getModel()->gallery()->where('collection', $this->getNameKey())->get();
    }
}

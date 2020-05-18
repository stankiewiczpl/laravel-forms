<?php


namespace Stankiewiczpl\LaravelForms\Fields;


use Kris\LaravelFormBuilder\Fields\FormField;

class Gallery extends FormField
{
    protected function getTemplate()
    {
        return 'forms::fields.gallery';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        return parent::render($options, $showLabel, $showField, $showError);
    }

    public function getDefaultValue($default = null)
    {
        return $this->parent->getModel()->gallery()->where('collection',$this->getNameKey())->get();
    }

}

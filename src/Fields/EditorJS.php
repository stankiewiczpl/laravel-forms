<?php


namespace Stankiewiczpl\LaravelForms\Fields;


use Kris\LaravelFormBuilder\Fields\FormField;

class EditorJS extends FormField
{
    protected function getTemplate()
    {
        return 'forms::fields.editorjs';
    }

    public function getDefaultValue($default = null)
    {
        $block =  $this->parent->getModel()->blocks()->where('field',$this->getNameKey())->first();

        return $block->blocks;
    }

}

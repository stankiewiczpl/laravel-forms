<?php


namespace Stankiewiczpl\LaravelForms;

use Proengsoft\JsValidation\Facades\JsValidatorFacade;

class Form extends \Kris\LaravelFormBuilder\Form
{
    public function makeJsValidator()
    {
        $this->getFormHelper()->mergeFieldsRules($this->getFields());
        $formFields = $this->getFormHelper()->mergeFieldsRules($this->getFields());
        $rules = $formFields->getRules();
        $attributes = $formFields->getAttributes();
        $messages = $formFields->getMessages();
        return  JsValidatorFacade::make($rules, $attributes, $messages, '#'.$this->getFormOption('id'));
    }
}

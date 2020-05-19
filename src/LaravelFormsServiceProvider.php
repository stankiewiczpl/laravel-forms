<?php

namespace Stankiewiczpl\LaravelForms;

use Collective\Html\FormBuilder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class LaravelFormsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        FormBuilder::component('bs_text', 'forms::fields.text', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        FormBuilder::component('bs_textarea', 'forms::fields.textarea', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        FormBuilder::component('bs_password', 'forms::fields.password', ['name', 'label' => null, 'attributes' => []]);
        FormBuilder::component('bs_email', 'forms::fields.email', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        FormBuilder::component('bs_select', 'forms::fields.select', ['name', 'label' => null, 'options' => [], 'value' => null, 'attributes' => []]);
        FormBuilder::component('bs_upload', 'forms::fields.upload', ['name', 'value' => null, 'attributes' => []]);

        $this->bootValidationRules();

        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'forms');
        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([__DIR__.'/../database/migrations/' => database_path('migrations')], 'migrations');
        $this->publishes([__DIR__.'/../resources/views' => resource_path('views/vendor/laravel-forms'),]);
        $this->publishes([__DIR__.'/config/config.php' => config_path('laravel-forms.php')]);


    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'laravel-forms');
    }

    private function bootValidationRules()
    {
        Validator::extend('editorjs', '\\Stankiewiczpl\\LaravelForms\\Rules\\EditorJs@validate','Pole :attribute jest nieprawidłowe.');
    }
}

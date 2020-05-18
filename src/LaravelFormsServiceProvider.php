<?php

namespace Stankiewiczpl\LaravelForms;

use Collective\Html\FormBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

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

        $this->loadViewsFrom(__DIR__ . '/../views/', 'forms');
        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([__DIR__.'/../database/migrations/' => database_path('migrations')], 'migrations');


    }

    public function register()
    {
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/laravel-forms'),
        ]);
    }
}

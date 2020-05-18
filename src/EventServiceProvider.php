<?php

namespace Stankiewiczpl\LaravelForms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();
/*
        Event::listen('eloquent.saved:*', function ($event, $models) {

            foreach ($models as $model)
            {
                if($model instanceof EloquentGalleryInterface)
                {
                    dd($model);
                }
            }
        });
*/
    }
}

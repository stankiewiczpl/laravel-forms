<?php

namespace Stankiewiczpl\LaravelForms\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Stankiewiczpl\LaravelForms\Models\Image;

trait ModelHasGallery
{
    public static function bootModelHasGallery()
    {
        static::saved(function (Model $model) {
            foreach (request()->all() as $attribute => $value) {
                if (Str::startsWith($attribute, 'gallery_')) {
                    $model->saveGalleryImages($attribute);
                }
            }
        });
    }

    public function gallery(): MorphMany
    {
        return $this->morphMany(Image::class, 'model_images')->defaultOrder();
    }

    protected function saveGalleryImages($attribute):void
    {
        $sortOrder = Arr::get(request($attribute), 'order') ? explode(',', Arr::get(request($attribute), 'order')) : [];
        $images = Arr::get(request($attribute), 'files', []);
        $items = count($sortOrder) ? $sortOrder : $images;

        if (count($items)) {
            $data = [];
            foreach ($items as $uuid) {
                $image = Image::query()->where('uuid', $uuid)->get()->first();
                if ($image) {
                    try {
                        $this->gallery()->save($image);
                        $data[] = ['id' => $image->id];
                    } catch (\Exception $exception) {
                        Log::warning($exception->getMessage());
                        continue;
                    }
                }
            }
            $this->gallery()->rebuildTree($data);
        }
    }
}

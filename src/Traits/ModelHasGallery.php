<?php

namespace Stankiewiczpl\LaravelForms\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Stankiewiczpl\LaravelForms\Models\Image;

trait ModelHasGallery
{
    public static function bootModelHasGallery()
    {
        static::saved(function (Model $model) {

            foreach (request()->input('gallery',[]) as $collection=>$gallery)
            {
              // dump($collection);
              // dump($gallery);
               self::saveGallery($gallery,$model);
            }
          //  dd(request()->input('gallery'));
          //  dd('end');
        });
    }

    public function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')->defaultOrder();
    }

    public static function saveGallery($gallery,$model)
    {

        $sortOrder = Arr::get($gallery,'order') ? explode(',', Arr::get($gallery,'order')) : [];
        $images = Arr::get($gallery,'files',[]);


        $items = count($sortOrder) ? $sortOrder : $images;
        //dump($items);
        $data = [];
        if (count($items)) {
            foreach ($items as $uuid) {
                $image = Image::query()->where('uuid',$uuid)->get()->first();

                if ($image) {
                    try {
                        $model->gallery()->save($image);
                        $data[] = ['id' => $image->id];
                    } catch (\Exception $exception) {
                        Log::debug($exception->getMessage());
                        continue;
                    }
                }
            }
            //dump($data);
            $model->gallery()->rebuildTree($data);
        }

    }
}

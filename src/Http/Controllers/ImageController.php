<?php

namespace Stankiewiczpl\LaravelForms\Http\Controllers;

use App\Http\Controllers\Controller;
use Stankiewiczpl\LaravelForms\Models\Image as ImageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    protected $extension = 'jpg';

    public function upload(Request $request)
    {
        $collection = $request->header('collection');
        $uuid = Str::uuid()->toString();
        try {
            $file = Arr::first($request->file( $collection.'.files'));


            $src = Image::make($file)
                ->widen(800, function ($constraint) {
                    $constraint->upsize();
                });

            Storage::disk('public')->put('uploads/' . $uuid . '.' . $this->extension, $src->encode());
            $image = ImageModel::create(
                [
                    'uuid' => $uuid,
                    'directory' => 'images',
                    'filename' => $uuid,
                    'extension' => $this->extension,
                    'title' => null,
                    'flag' => null,
                    'collection' => $collection
                ]
            )->user()->associate($request->user());
            return response($image->uuid, 200)->header('Content-Type', 'text/plain');
        } catch (\Exception $exception) {
            Log::debug($exception->getMessage());
            abort(500);
        }
    }

    public function preview($uuid)
    {
        $image = \Stankiewiczpl\LaravelForms\Models\Image::query()->where('uuid',$uuid)->firstOrFail();
        if (!file_exists($image->path)) {
            abort(404);
        }


        return Image::make($image->path)
            ->fit(245, 150, function (Constraint $constraint) {
                $constraint->upsize();
            })
            ->response('jpg', 60);

    }

    public function delete(Request $request)
    {
        ImageModel::query()->where('uuid',$request->uuid)->delete();
        return response()->json();
    }
}

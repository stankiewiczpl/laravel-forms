<?php

namespace Stankiewiczpl\LaravelForms\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Image extends Model
{
    use NodeTrait;

    protected $table = 'model_has_images';

    protected $fillable = ['uuid','directory','filename','extension','title','flag','collection'];

    protected function getScopeAttributes()
    {
        return ['model_images_type','model_images_id'];
    }

    public function model_images()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPathAttribute()
    {
        return storage_path('app/public/uploads/'.$this->attributes['filename'].'.'.$this->attributes['extension']);
    }

    public function resize($w = '500', $h = null, $quality = 99, $format = 'webp')
    {
        $size = $h ? $w.'x'.$h : $w;

        $destination_dir_path = storage_path('app/public/custom/'.$this->directory.'/'.$size);

        if (file_exists($this->path)) {
            if (!file_exists($destination_dir_path.'/'.$this->filename.'.'.$format)) {
                if (!is_dir($destination_dir_path)) {
                    \Illuminate\Support\Facades\File::makeDirectory($destination_dir_path, 0755, true);
                }
                $img =  \Intervention\Image\Facades\Image::make($this->path);
                $img->fit($w, $h, function ($constraint) {
                    $constraint->upsize();
                });

                //  $watermark = \Intervention\Image\Facades\Image::make(public_path('wtrpl-logo-desktop.png'));
                //$watermark->resize(ceil($w/7));
                //   $watermark->resize(ceil($w/7), null, function ($constraint) {
                //       $constraint->aspectRatio();
                //       $constraint->upsize();
                //   });
                //   $img->insert($watermark, 'bottom-right', 10, 10);
                //$img->insert(public_path('wtrpl-logo-desktop.png'), 'bottom-right', 10, 10);
                $img->save($destination_dir_path.'/'.$this->filename.'.'.$format, $quality, $format);
            }
        }

        $destination_file_url = asset('storage/custom/'.$this->directory.'/'.$size.'/'.$this->filename.'.'.$format);
        return $destination_file_url;
    }
}

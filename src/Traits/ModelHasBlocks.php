<?php

namespace Stankiewiczpl\LaravelForms\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use Illuminate\Support\Str;
use Stankiewiczpl\LaravelForms\Models\Block;

trait ModelHasBlocks
{
    public static function bootModelHasBlocks()
    {
        static::saved(function (Model $model) {
            foreach (request()->all() as $attribute => $value) {
                if (Str::startsWith($attribute, 'blocks_')) {
                    $model->saveBlocks($attribute);
                }
            }
        });
    }

    public function blocks(): MorphMany
    {
        return $this->morphMany(Block::class, 'model_blocks');
    }

    protected function saveBlocks($attribute):void
    {
        $this->blocks()->where('field',$attribute)->delete();
        $this->blocks()->create(['blocks'=>request()->input($attribute),'field'=>$attribute]);
    }
}

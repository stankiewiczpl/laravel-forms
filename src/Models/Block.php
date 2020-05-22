<?php


namespace Stankiewiczpl\LaravelForms\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'model_has_blocks';

    protected $fillable = ['blocks','field'];

    public function model_blocks()
    {
        return $this->morphTo();
    }
}

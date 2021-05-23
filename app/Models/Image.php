<?php

namespace App\Models;

use App\Traits\TranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use TranslationTrait;
    protected $guarded = [];
    protected $casts = ['image_title' => 'array' , 'image_alt' => 'array'];
    const PATH = 'app/images';

    public function getImageFileAttribute()
    {
        return $this->getAttribute('on_server') ?
            asset('uploads/'.self::PATH . '/' . $this->getAttribute('image')):
            config()->get('backblaze.base_image_url') . 'uploads/' .self::PATH . '/' . $this->getAttribute('image');
    }

    public function app()
    {
        return $this->belongsTo(App::class , 'app_id' , 'id');
    }
}

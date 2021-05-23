<?php

namespace App\Models;

use App\Traits\TranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use TranslationTrait;

    const PATH = '1000700';

    protected $casts = [
        'image_title' => 'array',
        'image_alt' => 'array',
    ];
    protected $guarded = [];

    protected $appends = ['image_file'];
    public function getImageFileAttribute()
    {
        return $this->getAttribute('on_server') ?
            asset('uploads/' . self::PATH . '/' . $this->getAttribute('image')) :
            config()->get('backblaze.base_image_url') . 'uploads/' . self::PATH . '/' . $this->getAttribute('image');
    }
}

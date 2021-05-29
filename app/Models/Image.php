<?php

namespace App\Models;

use App\Traits\TranslationTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * @package App\Models
 */
class Image extends Model
{
    use TranslationTrait;
    /**
     * @var array
     */
    protected $guarded = [];
    /**
     * @var array
     */
    protected $casts = ['image_title' => 'array', 'image_alt' => 'array'];
    /**
     *
     */
    const PATH = 'app/images/';

    /**
     * @return mixed
     */
    public function getImageFileAttribute()
    {
        return $this->getAttribute('image');
//        return $this->getAttribute('on_server') ?
//            asset('uploads/'.self::PATH . $this->getAttribute('image')):
//            config()->get('backblaze.base_image_url') . 'uploads/' .self::PATH .  $this->getAttribute('image');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function app()
    {
        return $this->belongsTo(App::class, 'app_id', 'id');
    }

    /**
     * @param $column
     * @param string $locale
     * @return mixed
     */
    public function translation($column, $locale = 'en')
    {
        return $this->getAttribute($column);
    }
}

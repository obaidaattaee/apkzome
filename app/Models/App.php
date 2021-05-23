<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * Class App
 * @package App\Models
 * @method static orderBy(string $string, string $string1)
 */
class App extends Model
{
    use SoftDeletes;
    use HasTranslations;

    const APP_LOGO_PATH = 'apps/logos';
    /**
     * @var string[]
     */
//    public $translatable = ['title', 'description'];
    protected $with = ['translations'];
    /**
     * @var array
     */
    protected $guarded = [];
    protected $appends = ['image_file' , 'title_translation'];
    protected $casts = ['published_at', 'datetime'];

    public function getImageFileAttribute()
    {
        return $this->getAttribute('image');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'app_tag', 'app_id', 'tag_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'app_id', 'id');
    }

    public function parts()
    {
        return $this->hasMany(AppParts::class, 'app_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(Vendor::class, 'owner_id', 'id');
    }

    public function OSType()
    {
        return $this->belongsTo(OSType::class, 'os_type_id', 'id');
    }

    public function OSVersion()
    {
        return $this->belongsTo(OSVersion::class, 'os_version_id', 'id');
    }

    public function versions()
    {
        return $this->hasMany(AppVersion::class, 'app_id', 'id')->orderBy('sort_number');
    }

    public function getTitleTranslationAttribute(){
        return $this->translation('title' , app()->getLocale());
    }

    public function translation($column, $locale = 'en')
    {
//        return $this->translations()->first()->getAttribute($column);
        return ucwords($this->getAttribute($column));
    }

    public function translations()
    {
        return $this->hasMany(AppTranslation::class, 'app_id', 'id');
    }
}

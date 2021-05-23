<?php

namespace App\Models;

use App\Traits\TranslationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use SoftDeletes;
    use TranslationTrait;

    protected $guarded = [];

    protected $casts = [
        'title' => 'array'
    ];

}

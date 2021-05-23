<?php

namespace App\Models;

use App\Traits\TranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use TranslationTrait;

    const SECTIONS = [
        [
            'id' => 1,
            'title' => [
                'en' => 'Descover'
            ]
        ], [
            'id' => 2,
            'title' => [
                'en' => 'Popular Apps'
            ]
        ], [
            'id' => 3,
            'title' => [
                'en' => 'Popular Games'
            ]
        ], [
            'id' => 4,
            'title' => [
                'en' => 'Coming Soon Games/Apps'
            ]
        ], [
            'id' => 5,
            'title' => [
                'en' => 'Top Trending Games/Apps'
            ]
        ]
    ];
    protected $guarded = ['id'];
    protected $casts = ['title' => 'array'];

    public function apps()
    {
        return $this->belongsToMany(App::class, 'app_section', 'section_id', 'app_id')->orderBy('id' , 'desc');
    }
}

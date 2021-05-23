<?php

namespace App\Models;

use App\Traits\TranslationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 */
class Category extends Model
{
    use SoftDeletes;
    use TranslationTrait;

    /**
     *
     */
    const CATEGORIES = [
        [
            'id' => 1,
            'title' => '{"ar":"\u0627\u0644\u0639\u0627\u0628","en":"games"}',
            'description' => 'game category',
            'icon' => "fas fa-gamepad"
        ], [
            'id' => 2,
            'title' => '{"ar":"\u062a\u0637\u0628\u064a\u0642\u0627\u062a","en":"apps"}',
            'description' => 'app category',
            'icon' => "fab fa-app-store-ios"
        ]
    ];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_active' => 'boolean',
        'title' => 'array',
    ];

    /**
     * @return HasMany
     */
    public function apps(): HasMany
    {
        return $this->hasMany(App::class, 'category_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function parentCategory() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_category', 'id');
    }
    /**
     * @return HasMany
     */
    public function chlidrens() : HasMany
    {
        return $this->hasMany(Category::class, 'parent_category', 'id');
    }
}

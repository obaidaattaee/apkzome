<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class AppVersion
 * @package App\Models
 */
class AppVersion extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
    /**
     * @var string[]
     */
    protected $casts = ['published_at' => 'date'];

    /**
     * @return BelongsTo
     */
    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class, 'app_id', 'id');
    }

    public function OSVersion() {
        return $this->belongsTo(OSVersion::class , 'os_version_id' , 'id');
    }
}

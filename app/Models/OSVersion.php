<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OSVersion extends Model
{
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(OSType::class, 'os_type_id', 'id');
    }
}

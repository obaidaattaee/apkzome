<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    const PATH = "vendors/";
    protected $guarded = [];
    protected $appends = ['image_file' ];

    public function getImageFileAttribute()
    {
        return $this->getAttribute('on_server') ?
            asset('uploads/' . self::PATH . $this->getAttribute('image')) :
            config()->get('backblaze.base_image_url') . 'uploads/' . self::PATH . $this->getAttribute('image');
    }


}

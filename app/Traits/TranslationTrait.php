<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait TranslationTrait
{
    public function translation($column, $locale = 'en')
    {
        $column = $this->getAttribute($column);
        return Arr::get($column , $locale , $column['en']);
    }

}

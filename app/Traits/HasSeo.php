<?php

namespace App\Traits;

trait HasSeo
{
    public static function bootHasSeo()
    {
        static::saving(function ($model) {
        });
    }

}

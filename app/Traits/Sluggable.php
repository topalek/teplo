<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    public static function bootSluggable()
    {
        static::saving(function ($model) {
            $settings = $model::sluggable();
            $model->slug = Str::slug($model->$settings['source'], language: 'ru');
        });
    }

    public static function sluggable(): array
    {
        return ['source' => 'title',];
    }
}

<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    public static function bootSluggable()
    {
        static::saving(function ($model) {
            $settings = $model::sluggable();
            $field = $settings['source'];
            if (!$model->exists()){
                $model->slug = Str::slug($model->$field, language: 'ru');
            }
            if ($model->isDirty('slug')){
                $model->slug = Str::slug($model->slug, language: 'ru');
            }
        });
    }

    public static function sluggable(): array
    {
        return ['source' => 'title',];
    }
}

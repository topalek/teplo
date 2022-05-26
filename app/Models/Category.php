<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $parent_id
 * @property string $created_at
 *
 *
 */
class Category extends Model
{
    use HasFactory;

    public function attributeLabels(): array
    {
        return [
            'id'          => __('ID'),
            'title'       => __('Title'),
            'slug'        => __('Slug'),
            'description' => __('Description'),
            'parent_id'   => __('Parent ID'),
            'created_at'  => __('Create at'),
            'updated_at'  => __('Update at'),
        ];
    }


}

<?php

namespace App\Models;

use App\Traits\Sluggable;
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
    use HasFactory, Sluggable;

    protected $fillable = ['title', 'slug', 'description', 'parent_id'];

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

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'id', 'parent_id');
    }

    public function getParentTitleAttribute(): string
    {
        return $this->parent ? $this->parent->title : 'Родительская';
    }
}

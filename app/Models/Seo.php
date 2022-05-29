<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $h1
 * @property string $text
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property bool $noindex
 * @property bool $nofollow
 * @property bool $in_sitemap
 * @property bool $is_canonical
 * @property int $created_at
 * @property int $updated_at
 *
 */
class Seo extends Model
{
    use HasFactory;

    protected $fillable = [
        'h1',
        'text',
        'title',
        'keywords',
        'description',
        'noindex',
        'nofollow',
        'in_sitemap',
        'is_canonical',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        self::created(function ($model) {
            // ... code here
        });

        self::updating(function ($model) {
            // ... code here
        });

        self::updated(function ($model) {
            // ... code here
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            // ... code here
        });
    }
}

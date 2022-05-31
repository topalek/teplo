<?php

namespace App\Models;

use App\Traits\HasSeo;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable, HasSeo;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

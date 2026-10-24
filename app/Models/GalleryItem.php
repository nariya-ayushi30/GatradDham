<?php

namespace App\Models;

use App\Traits\HasBilingual;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasBilingual;

    protected $guarded = [];

    public function getTitleAttribute()
    {
        return $this->getLocalized('title');
    }
}

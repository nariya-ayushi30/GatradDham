<?php

namespace App\Models;

use App\Traits\HasBilingual;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasBilingual;

    protected $guarded = [];

    protected $casts = [
        'published_date' => 'date',
    ];

    public function getTitleAttribute()
    {
        return $this->getLocalized('title');
    }

    public function getExcerptAttribute()
    {
        return $this->getLocalized('excerpt');
    }

    public function getContentAttribute()
    {
        return $this->getLocalized('content');
    }
}

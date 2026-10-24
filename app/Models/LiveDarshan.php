<?php

namespace App\Models;

use App\Traits\HasBilingual;
use Illuminate\Database\Eloquent\Model;

class LiveDarshan extends Model
{
    use HasBilingual;

    protected $guarded = [];

    protected $casts = [
        'is_live' => 'boolean',
    ];

    public function getTitleAttribute()
    {
        return $this->getLocalized('title');
    }

    public function getNoticeAttribute()
    {
        return $this->getLocalized('notice');
    }
}

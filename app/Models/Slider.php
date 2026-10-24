<?php

namespace App\Models;

use App\Traits\HasBilingual;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasBilingual;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function getTitleAttribute()
    {
        return $this->getLocalized('title');
    }

    public function getSubtitleAttribute()
    {
        return $this->getLocalized('subtitle');
    }

    public function getButtonTextAttribute()
    {
        return $this->getLocalized('button_text');
    }
}

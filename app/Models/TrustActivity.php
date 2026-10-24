<?php

namespace App\Models;

use App\Traits\HasBilingual;
use Illuminate\Database\Eloquent\Model;

class TrustActivity extends Model
{
    use HasBilingual;

    protected $guarded = [];

    public function getTitleAttribute()
    {
        return $this->getLocalized('title');
    }

    public function getSubtitleAttribute()
    {
        return $this->getLocalized('subtitle');
    }

    public function getDescriptionAttribute()
    {
        return $this->getLocalized('description');
    }

    public function getStatsAttribute()
    {
        return $this->getLocalized('stats');
    }
}

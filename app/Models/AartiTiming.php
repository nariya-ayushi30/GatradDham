<?php

namespace App\Models;

use App\Traits\HasBilingual;
use Illuminate\Database\Eloquent\Model;

class AartiTiming extends Model
{
    use HasBilingual;

    protected $guarded = [];

    public function getTitleAttribute()
    {
        return $this->getLocalized('title');
    }

    public function getTimeAttribute()
    {
        return $this->getLocalized('time');
    }

    public function getDescAttribute()
    {
        return $this->getLocalized('desc');
    }

    public function getBadgeAttribute()
    {
        return $this->getLocalized('badge');
    }
}

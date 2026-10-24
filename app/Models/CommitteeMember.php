<?php

namespace App\Models;

use App\Traits\HasBilingual;
use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    use HasBilingual;

    protected $guarded = [];

    public function getNameAttribute()
    {
        return $this->getLocalized('name');
    }

    public function getDesignationAttribute()
    {
        return $this->getLocalized('designation');
    }

    public function getVillageAttribute()
    {
        return $this->getLocalized('village');
    }
}

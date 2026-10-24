<?php

namespace App\Models;

use App\Traits\HasBilingual;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory, HasBilingual;

    protected $guarded = [];
}

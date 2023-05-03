<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Badges extends Model
{
    public $table = 'badges';
    public $timestamps = false;
}

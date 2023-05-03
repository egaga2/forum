<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Categories extends Model
{
    public $table = 'categories';
    public $timestamps = false;
    protected $fillable = [
        'catid',
        'name',
        'description',
        'permalink',
        'status'
    ];

    public function question()
    {
        return $this->hasMany(Questions::class, 'catid', 'id')->where('status', 1);
    }
}

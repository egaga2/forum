<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Answers extends Model
{
    public $table = 'answers';
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid')->select(['id', 'name', 'image', 'votes', 'badgesGold', 'badgesSilver', 'badgesBronze', 'peopleReached']);
    }

    public function question()
    {
        return $this->hasOne(Questions::class, 'id', 'qid');
    }

}

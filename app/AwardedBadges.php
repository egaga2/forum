<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AwardedBadges extends Model
{
    public $table = 'awardedBadges';
    public $timestamps = false;

    public function badges()
    {
        return $this->hasOne(Badges::class, 'id', 'badgeId');
    }

    public function gold()
    {
        return $this->hasOne(Badges::class, 'id', 'badgeId')->where('priority', 1);
    }
    public function silver()
    {
        return $this->hasOne(Badges::class, 'id', 'badgeId')->where('priority', 2);
    }
    public function bronze()
    {
        return $this->hasOne(Badges::class, 'id', 'badgeId')->where('priority', 3);
    }
}

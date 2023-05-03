<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    public $table = 'notifications';
    public $timestamps = false;

    public function by()
    {
        return $this->hasOne(User::class, 'id', 'by')->select(['name', 'id']);
    }

    public function for()
    {
        return $this->hasOne(User::class, 'id', 'for')->select(['name', 'id']);
    }

    public function schema()
    {
        return $this->hasOne(NotificationSchema::class, 'id', 'nsId');
    }

    public function badges()
    {
        return $this->hasOne(Badges::class, 'id', 'badgeId');
    }
    public function reputation()
    {
        return $this->hasOne(ReputationRecord::class, 'id', 'repId');
    }

    public function question()
    {
        return $this->hasOne(Questions::class, 'id', 'qid');
    }
}

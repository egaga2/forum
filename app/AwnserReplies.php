<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AwnserReplies extends Model
{
    public $table = 'awnserReplies';
    public $timestamps = false;

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'userid');
    }
}

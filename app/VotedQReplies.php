<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VotedQReplies extends Model
{
    public $table = 'votedQReplies';
    public $timestamps = false;

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'userid');
    }
}

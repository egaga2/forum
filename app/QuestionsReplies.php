<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionsReplies extends Model
{
    public $table = 'questionsReplies';
    public $timestamps = false;

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'userid');
    }
}

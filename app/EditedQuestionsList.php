<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditedQuestionsList extends Model
{
    public $table = 'editedQuestionsList';
    public $timestamps = false;

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'userid')->select(['id', 'name', 'image', 'votes', 'badgesGold', 'badgesSilver', 'badgesBronze', 'peopleReached']);
    }
}

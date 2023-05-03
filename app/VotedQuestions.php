<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VotedQuestions extends Model
{
    public $table = 'votedQuestions';
    public $timestamps = false;
}

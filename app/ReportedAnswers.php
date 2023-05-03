<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportedAnswers extends Model
{
    public $table = 'reportedAnswers';
    public $timestamps = false;

    public function schema()
    {
        return $this->hasOne(ReportSchema::class, 'id', 'rsid');
    }
    public function answer()
    {
        return $this->hasOne(Answers::class, 'id', 'qaid');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid');
    }
}

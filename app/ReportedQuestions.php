<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportedQuestions extends Model
{
    public $table = 'reportedQuestions';
    public $timestamps = false;
    public function schema()
    {
        return $this->hasOne(ReportSchema::class, 'id', 'rsid');
    } public function question()
    {
        return $this->hasOne(Questions::class, 'id', 'qid');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid');
    }
}

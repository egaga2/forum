<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Questions extends Model
{
    public $table = 'questions';
    public $timestamps = false;
//    use Sluggable;
//
//    /**
//     * Return the sluggable configuration array for this model.
//     *
//     * @return array
//     */
//    public function sluggable()
//    {
//        return [
//            'slug' => [
//                'source' => 'title'
//            ]
//        ];
//    }

//    protected $fillable = [
//        'title',
//        'description',
//        'slug',
//        'appid',
//        'summary',
//        'recentChange',
//        'size',
//        'appVersion',
//        'androidVersion',
//        'locale',
//        'country',
//    ];
    public function User()
    {
        return $this->hasOne(User::class, 'id', 'userid')->select(['id', 'name','image','votes','badgesGold','badgesSilver','badgesBronze','peopleReached']);
    }

    public function Cate()
    {
        return $this->hasOne(Categories::class, 'id', 'catid')->select(['name', 'permalink']);
    }
    public function answer()
    {
        return $this->hasMany(Answers::class, 'qid', 'id');
    }
}

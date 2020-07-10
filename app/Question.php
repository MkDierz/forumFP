<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\Answer;
use App\QuestionComment;
class Question extends Model
{
    //
    public function users()
    {
        return $this->belongsTo('App\User', 'pembuat_pertanyaan_id','id');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer','untuk_pertanyaan_id');
    }

    public function question_comments()
    {
        return $this->hasMany('App\QuestionComment','questions_id','id');
    }
    public function votes(){
        return $this->hasMany('App\VoteQuestion','question_id','id');
    }
}

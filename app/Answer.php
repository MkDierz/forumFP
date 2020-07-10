<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\AnswerComment;
class Answer extends Model
{
    //
    public function questions()
    {
        return $this->belongsTo('App\Question');
    }

    public function answer_comments()
    {
        return $this->hasMany('App\AnswerComment','answers_id');
    }
    public function user()
    {
    	return $this->belongsTo('App\User','pembuat_jawaban_id','id');
    }
    public function votes(){
        return $this->hasMany('App\VoteAnswer','answer_id','id');
    }
}

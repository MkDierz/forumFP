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
}

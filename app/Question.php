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
        return $this->belongsTo('App\User');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer','questions_id');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag','questions_id');
    }

    public function question_comments()
    {
        return $this->hasMany('App\QuestionComment','questions_id');
    }
}

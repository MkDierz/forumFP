<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class QuestionComment extends Model
{
    protected $table = 'question_comments';

    public function Questions()
    {
        return $this->belongsTo('App\Question');
    }
}

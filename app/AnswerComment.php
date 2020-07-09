<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\Table\Table;
use App\Answer;

class AnswerComment extends Model
{
    protected $table = 'answer_comments';

    public function Answers()
    {
        return $this->belongsTo('App\Answer');
    }
}

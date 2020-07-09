<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\Answer;
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
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteQuestion extends Model
{
    //
    protected $table = 'vote_questions';
    public static function diffQues(){
        $questionvp = VoteQuestion::where('votes','=', 1)->count();;
        $questionvn = VoteQuestion::where('votes','=', -1)->count();
        return $questionvp - $questionvn;
    }
}

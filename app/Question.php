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

    public function tags()
    {
        return $this->hasMany('App\Tag','questions_id');
    }

    public function question_comments()
    {
        return $this->hasMany('App\QuestionComment','questions_id','id');
    }
    public function votes(){
        return $this->hasMany('App\VoteQuestion','question_id','id');
    }
    public static function totalQuestionVotesDari($user_id){//total vote dari user_id dengan id answer_id
        $data = Question::all()->where('pembuat_pertanyaan_id', $user_id);
        $nVotes = 0;
        foreach ($data as $key => $value) {
            $np = $data[$key]->votes->where('votes',1)->count();
            $nn = $data[$key]->votes->where('votes',-1)->count();
            $nVotes += $np - $nn;
        }
            // ['pembuat_jawaban_id', $user_id],
            // // ['pembuat_jawaban_id', $user_id],
            // ]);
        // $data = Answer::all()->where([
        //     ['pembuat_jawaban_id', $user_id],
        //     ['pembuat_jawaban_id', $user_id],
        //     ]);
        // dd($data[0]->votes->where('votes',0)->count());
        // dd($nVotes);
        return $nVotes;
    }
}

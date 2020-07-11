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
        return $this->belongsTo('App\Question','untuk_pertanyaan_id','id');
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
    public static function totalJawabanVotesDari($user_id){//total vote dari user_id dengan id answer_id
        $data = Answer::all()->where('pembuat_jawaban_id', $user_id);
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
    public static function jumlahRelevan($id){
        $nRelevan = Answer::all()
        ->where('pembuat_jawaban_id',$id)
        ->where('is_selected',1)->count();
        // dd($nRelevan);
        return $nRelevan;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteAnswer extends Model
{
    //
    protected $table = 'vote_answers';
    
    public function answer(){
        return $this->belongsTo('App\Answer','answer_id','id');
    }
    public static function jumlahDownVote($user_id){
        $data = VoteAnswer::all()->where('pemberi_vote_jawaban_id',$user_id)
                                    ->where('votes',-1)
                                    ->count();
        // dd($data);
        return $data;
    }
}

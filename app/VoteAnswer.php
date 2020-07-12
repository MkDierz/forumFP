<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\VoteAnswer;
use App\User;
Use Alert;

class VoteAnswer extends Model
{
    protected $table = 'vote_answers';
    
    public function answer(){
        return $this->belongsTo('App\Answer','answer_id','id');
    }
    public static function lastValue($answer_id, $user_id){
        $vote = new VoteAnswer;
        $data = $vote::all()->where('pemberi_vote_jawaban_id','=', $user_id);
        if($data->first()!=null){
            $path = $data->where('answer_id', $answer_id)->first();
            if($path!=null){
                $lastV = $path->votes;
            }else{
                $lastV =0;
            }
        }else{
            $lastV = null;
        }
        return $lastV;

    }
    public static function giveVote($answer_id, $pemberi_vote_id, $value){
        $vote = new VoteAnswer;
        if(!(User::poin($pemberi_vote_id)<15 && $value==-1)){
            $kondisi = VoteAnswer::lastValue($answer_id,$pemberi_vote_id);
            if($kondisi!=null||$kondisi===0){
                $vote::where('pemberi_vote_jawaban_id','=', $pemberi_vote_id)
                ->update([
                    'answer_id'=>$answer_id,
                    'votes'=>$value
                ]);         
            }else{
                $vote->answer_id = $answer_id;
                $vote->pemberi_vote_jawaban_id = $pemberi_vote_id;
                $vote->votes = (int)$value;
                $vote->save();
            }
            
        }else{
            Alert::info('Reputasi Tidak Memenuhi', 'Untuk dapat melakukan downvote reputasi harus lebih dari 15');
        }
    }

    public static function jumlahDownVote($user_id){
        $data = VoteAnswer::all()->where('pemberi_vote_jawaban_id',$user_id)
                                    ->where('votes',-1)
                                    ->count();
        return $data;
    }
   
}

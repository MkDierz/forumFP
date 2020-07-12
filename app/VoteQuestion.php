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
    public static function jumlahDownVote($user_id){
        $data = VoteQuestion::all()->where('pemberi_vote_pertanyaan_id',$user_id)
                                    ->where('votes',-1)
                                    ->count();
        // dd($data);
        return $data;
    }

    public static function lastValue($question_id, $user_id){
        $vote = new VoteQuestion;
        $data = $vote::all()->where('pemberi_vote_pertanyaan_id','=', $user_id);
        if($data->first()!=null){
            $path = $data->where('question_id', $question_id)->first();
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
    public static function giveVote($question_id, $pemberi_vote_id, $value){
        $vote = new VoteQuestion;
        if(!(User::poin($pemberi_vote_id)<15 && $value==-1)){
            $kondisi = VoteQuestion::lastValue($question_id,$pemberi_vote_id);
            if($kondisi!=null||$kondisi===0){
                $vote::where('pemberi_vote_pertanyaan_id','=', $pemberi_vote_id)
                ->update([
                    'question_id'=>$question_id,
                    'votes'=>$value
                ]);         
            }else{
                $vote->question_id = $question_id;
                $vote->pemberi_vote_pertanyaan_id = $pemberi_vote_id;
                $vote->votes = (int)$value;
                $vote->save();
            }
            
        }else{
            dd('hahah poin kurang');
        }
    }
}

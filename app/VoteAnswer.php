<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\VoteAnswer;
use App\User;

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
    public static function berikanVote($id, $request){
        $idUser = Auth::user()->id;
        $vote = new VoteAnswer;
        if(!(User::poin($idUser)<15 && $request->vote==-1)){
            // dd(User::poin($idUser));
            $vote->pemberi_vote_jawaban_id = $idUser;
            $vote->answer_id = $request->id;
            $data = $vote::all()->where('pemberi_vote_jawaban_id','=', $idUser);
            // dd($data);
            if($data->first()!=null){
                // dd('a');
                $path = $data->where('answer_id', $request->id)->first();
                $nowValue = (int)$request->vote;
                if($path!=null){
                    $lastValue = $path->votes;
                }else{
                    $lastValue =0;
                }
                $vote->votes = $lastValue;
                // dd($lastValue);
                if($lastValue<$nowValue){
                    $vote->votes +=1;
                }else if($lastValue>$nowValue){
                    $vote->votes -=1;
                }
                // dd($vote->votes);
                $vote::where('pemberi_vote_jawaban_id','=', $idUser)
                ->update([
                    'answer_id'=>$request->id,
                    'votes'=>$vote->votes
                ]);         
            }else{
                // dd('data kosong');
                $vote->votes = (int)$request->vote;
                $vote->save();
            }
            
        }else{
            dd('hahah poin kurang');
        }
        return 0;
    }
}

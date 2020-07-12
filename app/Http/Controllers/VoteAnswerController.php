<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\VoteAnswer;
use App\User;

class VoteAnswerController extends Controller
{
    public function vote($id, Request $request){
        $idUser = Auth::user()->id;
        VoteAnswer::giveVote($request->id, $idUser, $request->vote);
        return redirect('/question/'.$id);
    }

    public function votes($id, Request $request){
        $idUser = Auth::user()->id;
        $vote = new VoteAnswer;
        $vote->pemberi_vote_jawaban_id = $idUser;
        $vote->answer_id = $request->id;
        $vote->votes = $request->vote;
        $data =$vote::where('pemberi_vote_jawaban_id','=', $vote->pemberi_vote_jawaban_id)->first();
        if($data!=null){
            $vote::where('pemberi_vote_jawaban_id','=', $vote->pemberi_vote_jawaban_id) 
            ->update([
                'answer_id'=>$request->id,
                'votes'=>$request->vote
            ]);         
        }else{
            $vote->save();
        }
        return redirect('/question/'.$id);
    }
}

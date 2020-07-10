<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VoteQuestion;

class VoteQuestionController extends Controller
{
    //
    public function vote($id, Request $request){
        $vote = new VoteQuestion;
        $vote->user_id = Auth::user()->id;
        $vote->answer_id = $request->id;
        $vote->votes = $request->vote;
        $data =$vote::where('user_id','=', $vote->user_id)->first();
        if($data!=null){
            $vote::where('user_id','=', $vote->user_id) 
            ->update([
                'votes'=>$request->vote
            ]);         
        }else{
            $vote->save();
        }
        return redirect('/question');
    }
}

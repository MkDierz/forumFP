<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\VoteAnswer;

class VoteAnswerController extends Controller
{
    //
    public function vote($id, Request $request){
        $vote = new VoteAnswer;
        $vote->user_id = Auth::user()->id;
        $vote->answer_id = $request->id;
        $vote->votes = $request->vote;
        $data =$vote::where('user_id','=', $vote->user_id)->first();
        if($data!=null){
            $vote::where('user_id','=', $vote->user_id) 
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\VoteQuestion;

class VoteQuestionController extends Controller
{
    //
    public function vote(Request $request){
        $vote = new VoteQuestion;
        $vote->user_id = Auth::user()->id;
        $vote->question_id = $request->id;
        $vote->votes = $request->vote;
        // dd($vote);
        $data =$vote::where('user_id','=', $vote->user_id)->first();
        if($data!=null){
            $vote::where('user_id','=', $vote->user_id) 
            ->update([
                'question_id'=>$request->id,
                'votes'=>$request->vote
            ]);         
        }else{
            $vote->save();
        }
        return redirect('/');
    }
}

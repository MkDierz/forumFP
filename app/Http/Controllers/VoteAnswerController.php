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
        $vote->votes = $request->vote;
        // dd($request->vote);
        $vote->user_id = Auth::user()->id;
        $vote->answer_id = $request->id;
        $vote->save();
        return redirect('/question/'.$request->id);
        // dd($vote);
    }
}

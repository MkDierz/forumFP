<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Answer;

class AnswerController extends Controller
{
    public function store(Request $request){
        $answers = new Answer;
        $answers->content = $request->content;
        $answers->users_id = Auth::user()->id;
        $answers->questions_id = $request->question_id;
        $answers->save();

        return redirect('/question/'.$request->question_id);
    }

}

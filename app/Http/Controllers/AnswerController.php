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
        $answers->pembuat_jawaban_id = Auth::user()->id;
        $answers->untuk_pertanyaan_id = $request->question_id;
        $answers->save();

        return redirect('/question/'.$request->question_id);
    }
}

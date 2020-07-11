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

    public function relevan($aid,$qid){
        $relevan = Answer::find($aid);
        Answer::where('untuk_pertanyaan_id',$qid)->update([
        'is_selected' => 0
        ]);
        $relevan->is_selected = 1;
        $relevan->save();
        
        return redirect('/question/'.$qid);
    }

    public function lepasrelevan($qid){
        Answer::where('untuk_pertanyaan_id',$qid)->update([
            'is_selected' => 0
        ]);
        return redirect('/question/'.$qid);
    }

}

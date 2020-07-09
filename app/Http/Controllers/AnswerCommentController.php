<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Answer;
use App\AnswerComment;

class AnswerCommentController extends Controller
{
    //
    public function show($id){
        $answer = Answer::find($id);
        $comment = AnswerComment::join('users', 'answer_comments.users_id', '=', 'users.id')
        ->where('answer_comments.answers_id','=',$answer->id)
        ->get(['answer_comments.*','users.name']);
        //$count_comment = ;
        return view('comment.answerForm',compact('answer','comment'));
    }

    public function store(Request $request){
        $comment = new AnswerComment;
        $comment->content = $request->content;
        $comment->answers_id = $request->answers_id;
        $comment->users_id = Auth::user()->id;
        $comment->save();

        return redirect('/answerComment/show/'.$request->answers_id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionCommentController extends Controller
{
    public function show($id){
        $question = Question::find($id);
        $comment = QuestionComment::join('users', 'question_comments.users_id', '=', 'users.id')
        ->where('question_comments.questions_id','=',$question->id)
        ->get(['question_comments.*','users.name']);
        //$count_comment = ;
        return view('comment.questionForm',compact('question','comment'));
    }

    public function store(Request $request){
        $comment = new QuestionComment;
        $comment->content = $request->content;
        $comment->questions_id = $request->questions_id;
        $comment->users_id = Auth::user()->id;
        $comment->save();

        return redirect('/questionComment/show/'.$request->questions_id);
    }
}

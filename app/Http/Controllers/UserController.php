<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VoteAnswer;
use App\VoteQuestion;
use App\Answer;
use App\User;

class UserController extends Controller
{
    //
    public function index(){
        $question = Question::all();
        dd($question[0]->user);
    }
    public function show($id){
        $question = Question::find($id);
        $comment = QuestionComment::join('users', 'question_comments.users_id', '=', 'users.id')
        ->where('question_comments.questions_id','=',$question->id)
        ->get(['question_comments.*','users.name']);
        //$count_comment = ;
        $answersPoin = Answer::where(
            ['answers.user_id','=',$id],
            ['answers.user_is_selected','=',$id],
            ) //kasih keterangan
            ->select(['users.name','users.id as id_pembuat', 'answers.*'])
            ->withCount('answer_comments')
            ->get();
        return view('comment.questionForm',compact('question','comment'));
    }
}

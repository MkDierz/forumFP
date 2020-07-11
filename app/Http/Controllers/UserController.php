<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VoteAnswer;
use App\VoteQuestion;
use App\Answer;
use App\Question;
use App\User;

class UserController extends Controller
{
    //
    public function index($id){
        $user = User::find($id);
        $user->reputasi = User::poin($id);
        // dd(User::poin($id));
        return view('template.admin.profile',compact('user'));
    }
    public function show($id){
        $question = Question::find($id);
        $comment = QuestionComment::join('users', 'question_comments.users_id', '=', 'users.id')
        ->where('question_comments.questions_id','=',$question->id)
        ->get(['question_comments.*','users.name']);
        return view('comment.questionForm',compact('question','comment'));
    }
}

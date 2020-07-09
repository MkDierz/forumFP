<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Question;
use App\User;
use App\Tag;
use App\Answer;

class QuestionController extends Controller
{
    //
    public function index(){
        $questions = Question::join('users', 'questions.users_id', '=', 'users.id')
        ->get(['questions.*','users.name']);
        return view('template.forum.index',compact('questions'));
    }

    public function create(){
        return view('question.form');
    }

    public function store(Request $request){
        $question = new Question;
        $question->title = $request->title;
        $question->content = $request->content;
        $question->users_id = Auth::user()->id;
        $question->save();

        $result_tags = Tag::save_tags($request->all());
        return redirect('/');
    }
    public function show($id, Request $request){
        // $tdate = $request->Tdate;
        $question = Question::find($id);
        $answers = Answer::join('users', 'answers.users_id', '=', 'users.id')
            ->where('answers.questions_id','=',$question->id)
            ->get(['answers.*', 'users.name']);
        // $date = strtotime($details->created_at);
        // dd($answers);
        return view('template.forum.details', compact('question', 'answers'));
    }
}

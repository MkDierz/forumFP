<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Question;
use App\User;
use App\Tag;

class QuestionController extends Controller
{
    //
    public function index(){
        $questions = Question::join('users', 'questions.users_id', '=', 'users.id')
        ->get(['questions.*','users.name']);
        return view('question.index',compact('questions'));
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
    public function show($id){
        $details = Question::find($id);
        // dd($details);
        return view('question.show', compact('details'));
    }
}

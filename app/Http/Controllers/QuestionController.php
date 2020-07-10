<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Question;
use App\User;
use App\Tag;
use App\Answer;
use App\QuestionComment;
use App\VoteAnswer;
use App\VoteQuestion;

class QuestionController extends Controller
{
    //
    public function index(){
        $questions = Question::all();
            foreach ($questions as $key => $value) {
                $np = $questions[$key]->votes->where('votes','=',1)->where("id",'=',$questions[$key]->id)->count();
                $nn = $questions[$key]->votes->where('votes','=',-1)->where("id",'=',$questions[$key]->id)->count();
                $questions[$key]->jumlah_vote = $np - $nn;
            }

        return view('template.forum.index',compact('questions'));
    }

    public function create(){
        return view('question.form');
    }

    public function store(Request $request){
        $question = new Question;
        $question->title = $request->title;
        $question->content = $request->content;
        $question->pembuat_pertanyaan_id = Auth::user()->id;
        $question->save();

        $result_tags = Tag::save_tags($request->all());
        return redirect('/');
    }
    
    public function show($id, Request $request){
        $question = Question::find($id);
        // dd($question);
        $questionc = QuestionComment::where('questions_id','=',$id)->count();
        // $diff = VoteAnswer::diffAns($id);
        $answers = Answer::all()->where('untuk_pertanyaan_id','=',$id);
        // dd($answers);
        // dd($answers[0]->user);
        // $answers = Answer::join('users', 'answers.users_id', '=', 'users.id')//ambil jawaban dengan jenis pertanyaan yang sama
        //     ->where('answers.questions_id','=',$question->id) //kasih keterangan
        //     ->select(['users.name','users.id as id_pembuat', 'answers.*'])
        //     ->withCount('answer_comments')
        //     ->get();
        // $votes = Answer::join('vote_answers', 'vote_answers.answer_id', '=', 'answers.id' )
        //     ->select(['vote_answers.votes', 'answers.*'])
        //     ->get();
        // foreach ($answers as $key => $value) {
        //     // $np = $votes
        //     //     ->where("votes",'=', 1)
        //     //     ->where("id",'=',$value->id)
        //     //     ->count();
        //     // $nn = $votes
        //     //     ->where("id",'=',$value->id)
        //     //     ->where("votes",'=',-1)
        //     //     ->count();
        //     $answers[$key]->jumlah_vote = 0;
        // }
        foreach ($answers as $key => $value) {
            $np = $answers[$key]->votes->where('votes','=',1)->where("id",'=',$answers[$key]->id)->count();
            $nn = $answers[$key]->votes->where('votes','=',-1)->where("id",'=',$answers[$key]->id)->count();
            $answers[$key]->jumlah_vote = $np - $nn;
        }

        
        // dd($answers);
        return view('template.forum.details', compact('question', 'answers','questionc'));
    }
}

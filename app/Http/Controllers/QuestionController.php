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
        $questions = Question::join('users', 'questions.users_id', '=', 'users.id')
        ->select('questions.*','users.name')
        ->withCount('answers')
        ->orderBy('questions.id','desc')
        ->get();
        $tags = Tag::join('questions','tags.questions_id','=','questions.id')->get();
        // $questions->diff = VoteQuestion::diffQues();
        return view('template.forum.index',compact('questions','tags'));
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
        // dd($question);
        $questionc = QuestionComment::where('questions_id','=',$id)->count();
        // $diff = VoteAnswer::diffAns($id);
        $answers = Answer::join('users', 'answers.users_id', '=', 'users.id')//ambil jawaban dengan jenis pertanyaan yang sama
            ->where('answers.questions_id','=',$question->id) //kasih keterangan
            ->select(['users.name','users.id as id_pembuat', 'answers.*'])
            ->withCount('answer_comments')
            ->get();
        $votes = Answer::join('vote_answers', 'vote_answers.answer_id', '=', 'answers.id' )
            ->select(['vote_answers.votes', 'answers.*'])
            ->get();
        foreach ($answers as $key => $value) {
            $np = $votes
                ->where("votes",'=', 1)
                ->where("id",'=',$value->id)
                ->count();
            $nn = $votes
                ->where("id",'=',$value->id)
                ->where("votes",'=',-1)
                ->count();
            $answers[$key]->jumlah_vote = $np - $nn;
        }


        
        // dd($answers);
        return view('template.forum.details', compact('question', 'answers','questionc'));
    }

    public function edit($id){
        $edit = Question::find($id);
        $tag_edit = Tag::where('questions_id','=',$edit->id)->get();
        foreach($tag_edit as $data_tag){
            $resultstr[] = $data_tag->tag;
        }
        return view('template.forum.edit',compact('edit','resultstr'));
    }

    public function update($id, Request $request){
        $update = Question::find($id);
        $update->title = $request['title'];
        $update->content = $request['content'];
        $update->updated_at = now();
        $update->save();

        $delete_tag = Tag::where('questions_id','=',$id)->delete();
        $result_tags = Tag::update_tags($id, $request->all());

        return redirect('/question/'.$id);
    }

    public function destroy($id){
        $delete = Question::find($id);
        $delete->delete();

        return redirect('/');
    }
}

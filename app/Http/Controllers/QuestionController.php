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
Use Alert;

class QuestionController extends Controller
{
    //
    public function index(){
        // dd(Auth::guest());
        $questions = Question::withCount('answers')->get();
            foreach ($questions as $key => $value) {
                $np = $questions[$key]->votes->where('votes','=',1)->where("question_id",'=',$questions[$key]->id)->count();
                $nn = $questions[$key]->votes->where('votes','=',-1)->where("question_id",'=',$questions[$key]->id)->count();
                $questions[$key]->jumlah_vote = $np - $nn;
                if(!Auth::guest()){
                    $lsValue = VoteQuestion::lastValue($questions[$key]->id, Auth::user()->id);
                    if($lsValue!=null){
                        $questions[$key]->last_value = $lsValue;
                    }else{
                        $questions[$key]->last_value = 0;
                    }
                }
            }
            foreach ($questions as $key => $value) {
                $np = $questions[$key]->votes->where('votes','=',1)->where("question_id",'=',$questions[$key]->id)->count();
                $nn = $questions[$key]->votes->where('votes','=',-1)->where("question_id",'=',$questions[$key]->id)->count();
                $questions[$key]->jumlah_vote = $np - $nn;
            }
        $tags = Tag::join('questions','tags.questions_id','=','questions.id')->get();
        return view('template.forum.index',compact('questions','tags'));
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
        $questionc = QuestionComment::where('questions_id','=',$id)->count();
        $answers = Answer::where('untuk_pertanyaan_id','=',$id)->orderBy('is_selected','desc')->withCount('answer_comments')->get();
        if(!Auth::guest()){
            foreach ($answers as $key => $value) {
                $np = $answers[$key]->votes->where('votes','=',1)->where("answer_id",'=',$answers[$key]->id)->count();//dd($np);
                $nn = $answers[$key]->votes->where('votes','=',-1)->where("answer_id",'=',$answers[$key]->id)->count();
                $answers[$key]->jumlah_vote = $np - $nn;
                $lsValue = VoteAnswer::lastValue($answers[$key]->id, Auth::user()->id);
                if($lsValue!=null){
                    $answers[$key]->last_value = $lsValue;
                }else{
                    $answers[$key]->last_value = 0;
                }
            }
        }
        foreach ($answers as $key => $value) {
            $np = $answers[$key]->votes->where('votes','=',1)->where("answer_id",'=',$answers[$key]->id)->count();//dd($np);
            $nn = $answers[$key]->votes->where('votes','=',-1)->where("answer_id",'=',$answers[$key]->id)->count();
            $answers[$key]->jumlah_vote = $np - $nn;
        }
        

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

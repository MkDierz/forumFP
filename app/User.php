<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\VoteAnswer;
use App\VoteQuestion;
use App\Answer;
use App\Question;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function answers(){
        return $this->hasMany('App\Answer', 'pembuat_jawaban_id', 'id');;
    }
    public static function poin($id){
        $nRel = Answer::jumlahRelevan($id)*15;
        $nVotesAnswer = Answer::totalJawabanVotesDari($id)*10;
        $nVotesQuestion = Question::totalQuestionVotesDari($id)*10;
        $nDownVoteAnswer = VoteAnswer::jumlahDownVote($id);
        $nDownVoteQuestion = VoteQuestion::jumlahDownVote($id);
        $totalPoin = $nRel + $nVotesAnswer + $nVotesQuestion - $nDownVoteAnswer - $nDownVoteQuestion;
        return $totalPoin;
    }
}


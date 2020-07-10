<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Question;

class Tag extends Model
{
    //
    public static function save_tags($data){
        $tags = $data['tags'];
        $id = DB::getPdo()->lastInsertId();
        foreach(explode(',',$tags) as $row){
            $new_tags[] = DB::table('tags')->insert(
                [
                    'tag' => $row,
                    'questions_id' => $id
                ]
            );
        }
        
        return $new_tags;
    }

    public static function update_tags($id, $data){
        $tags = $data['tags'];
        foreach(explode(',',$tags) as $row){
            $new_tags[] = DB::table('tags')->insert(
                [
                    'tag' => $row,
                    'questions_id' => $id
                ]
            );
        }
        
        return $new_tags;
    }

    public function questions()
    {
        return $this->belongsTo('App\Question');
    }
}

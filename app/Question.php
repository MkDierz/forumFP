<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;
class Question extends Model
{
    //
    public function users()
    {
        return $this->belongsTo('User');
    }
}

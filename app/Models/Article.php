<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    //model ka ny lr tae form data twy ko thi ag loh model mr 
    protected $guarded=[];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }

}

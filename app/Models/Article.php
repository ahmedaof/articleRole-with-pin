<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable =[
        'title','content','category_id'
    ];

    public function category_id(){
       return $this->belongsTo(Category::class,'category_id','id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'article_id','id');
    }
}

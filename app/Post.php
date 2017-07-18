<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['id','title','body','author_id'];
    protected $table='posts';

    public function user()
    {
        return $this->belongsTo('App\User', 'author_id');
    }


    public function categories(){

        return $this->belongsToMany('App\Category', 'category_post', 'post_id', 'category_id');
    }
}

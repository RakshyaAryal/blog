<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloguser extends Model
{
    protected $table='author';
    protected $fillable=['name','email'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tag;

class Article extends Model
{
 protected $guarded = [];  //

public function user(){
   return $this->belongsTo(User::class, 'user_id' );
}
public function tags(){
    return $this->belongsToMany('App\Tag')->withTimestamps();
}


}

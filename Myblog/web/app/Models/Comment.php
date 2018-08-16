<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //设置模型主键名
     public $table = 'comments';
   	 //设置模型主键名
	 public $primaryKey = 'id';

	  //属于
	 public function commentarticles()
	 {
	 	return $this -> belongsTo('App\Models\Articles','art_id');
	 }

	  //属于
	 public function commentuser()
	 {
	 	return $this -> belongsTo('App\User','user_id');
	 }
}

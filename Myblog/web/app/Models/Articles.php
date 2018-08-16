<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{	
     //设置模型主键名
     public $table = 'articles';
   	 //设置模型主键名
	 public $primaryKey = 'id';

	 use SoftDeletes;
	 public $timestamps = true;
	 //属于
	 public function articlescates()
	 {
	 	return $this -> belongsTo('App\Models\Cate','cate_id');
	 }
}

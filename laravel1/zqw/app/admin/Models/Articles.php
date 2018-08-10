<?php

namespace App\admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{	
     //设置模型主键名
     public $table = 'Articles';
   	 //设置模型主键名
	 public $primaryKey = 'id';

	 use SoftDeletes;
	 public $timestamps = true;
}

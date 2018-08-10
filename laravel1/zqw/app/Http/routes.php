<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// 路由
Route::get('/', function () {
	echo 'sss';
    return view('welcome');
});


//后台首页控制器——————————————————————————————————————————————————————————————————————
Route::get('/admin','admin\IndexController@index');

//后台用户控制器——————————————————————————————————————————————————————————————————————
Route::resource('/admin/user','admin\UserController');

//文章控制器——————————————————————————————————————————————————————————————————————
//恢复
Route::get('/admin/articles/restore/{id}','admin\ArticlesController@restore');
//回收站
Route::get('/admin/articles/resyde','admin\ArticlesController@resyde');
//强制删除 
Route::get('/admin/articles/delete/{id}','admin\ArticlesController@delete');
//资源控制器
Route::resource('/admin/articles','admin\ArticlesController');

//分类控制器——————————————————————————————————————————————————————————————————————
//资源控制器
Route::resource('/admin/cates','admin\CatesController');








// Route::get('/form',function(){
// 	return view('form');
// });
// NotFoundHttpException in RouteCollection.php line 161:   404 路由加载失败
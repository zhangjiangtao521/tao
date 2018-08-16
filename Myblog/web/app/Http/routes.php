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

Route::get('/', function () {
    return view('welcome');
});




// 创建后台的友情链接
Route::resource('/admin/link','Admin\LinkController');

//后台首页控制器——————————————————————————————————————————————————————————————————————
Route::get('/admin','Admin\IndexController@index');

//后台用户控制器——————————————————————————————————————————————————————————————————————
Route::controller('/admin/user','Admin\UserController');

//后台文章控制器——————————————————————————————————————————————————————————————————————
Route::get('/admin/articles/restore/{id}','Admin\ArticlesController@restore');//恢复
Route::get('/admin/articles/resyde','Admin\ArticlesController@resyde');//回收站
Route::get('/admin/articles/delete/{id}','Admin\ArticlesController@delete');//强制删除 
Route::resource('/admin/articles','Admin\ArticlesController');//资源控制器

//后台分类控制器——————————————————————————————————————————————————————————————————————
Route::resource('/admin/cate','Admin\CateController');//资源控制器

//后台评论控制器——————————————————————————————————————————————————————————————————————
Route::post('/admin/comment/delete','Admin\CommentController@delete');//批量删除
Route::get('/admin/comment/down/{id}','Admin\CommentController@down');//禁用
Route::get('/admin/comment/up/{id}','Admin\CommentController@up');//激活
Route::resource('/admin/comment','Admin\CommentController');//资源控制器
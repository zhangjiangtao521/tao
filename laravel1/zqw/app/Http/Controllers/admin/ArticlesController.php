<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\admin\Models\Articles;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $search = $request -> input('search','');
        // dump($search);
        //分页
        $articles = Articles::where('title','like','%'.$search.'%')->paginate(5);
        // dd($articles);
       //加载文件模块
       return view('admin.articles.articles',['articles' => $articles,'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载模版
        return view('admin.articles.add');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dd($request->all());
        //接受数据
        $title = $request -> title;
        $descripition = $request -> descripition;
        $editor = $request -> editor;
        $cate_id = $request -> cate_id;
        $content = $request -> content;
        //创建文件 处理图片
        $thumb = $request ->file('thumb');
        //创建文件名
        $temp_name = str_random(20);
        //获取后缀名
        $ext = $thumb -> getClientOriginalExtension();
        //拼接文件名
        $name = $temp_name.'.'.$ext;
        //拼接路径
        $dir = './uploads/'.date('Ymd',time());
        //拼接向数据库储存的文件路径
        $filename = ltrim($dir.'/'.$name,'.');
           // dump($filename);
        //执行上传
        $thumb -> move($dir,$name);
        //传入数据库
        $articles = new Articles;
        $articles -> title = $title;
        $articles -> descripition = $descripition;
        $articles -> editor = $editor;
        $articles -> view = 0;
        $articles -> cate_id = $cate_id;
        $articles -> thumb = $filename;
        $articles -> content = $content;
        $res = $articles -> save();
        if($res){
            return redirect('/admin/articles');
        }else{
            return back();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Articles::find($id);
        return view('admin.articles.edit',['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //接受数据
        $title = $request -> title;
        $descripition = $request -> descripition;
        $editor = $request -> editor;
        $cate_id = $request -> cate_id;
        $content = $request -> content;
        //创建文件 处理图片
        $thumb = $request ->file('thumb');
        //创建文件名
        $temp_name = str_random(20);
        //获取后缀名
        $ext = $thumb -> getClientOriginalExtension();
        //拼接文件名
        $name = $temp_name.'.'.$ext;
        //拼接路径
        $dir = './uploads/'.date('Ymd',time());
        //拼接向数据库储存的文件路径
        $filename = ltrim($dir.'/'.$name,'.');
           // dump($filename);
        //执行上传
        $thumb -> move($dir,$name);
        //传入数据库
        $articles = Articles::find($id);
        $articles -> title = $title;
        $articles -> descripition = $descripition;
        $articles -> editor = $editor;
        $articles -> cate_id = $cate_id;
        $articles -> thumb = $filename;
        $articles -> content = $content;
        $res = $articles -> save();
        // dd($res);
        if($res){
            return redirect('/admin/articles');
        }else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   

       //软删除
       $res = Articles::destroy($id);
        //返回模版
       return back();
    }

    public function delete($id)
    {
        //强制删除
        $articles = Articles::find($id);
        $articles -> forceDelete();
        //返回模版
        return back();
    }

    public function resyde(Request $request)
    {   

         $search = $request -> input('search','');
        // dump($search);
        //分页
        // $articles = Articles::where('title','like','%'.$search.'%')->paginate(5);
        //获取软删除的数据  分页
       $articles = Articles::onlyTrashed()
                 -> where('title','like','%'.$search.'%')
                 -> paginate(5);
                    
        //加载模版
        return view('admin.articles.restore',['articles' => $articles,'search' => $search]);
    }

    public function restore($id)
    {   
        //恢复软删除数据
         $res = Articles::withTrashed()
                  -> where('id',$id)
                  -> restore();
        
        //返回模版
        return back();
   
    }
}

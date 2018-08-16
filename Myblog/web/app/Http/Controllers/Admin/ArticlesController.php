<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Articles;
use App\Models\Cate;
use DB;

class ArticlesController extends Controller
{   
     public static function getCates()
    {
         $cate = Cate::select('*',DB::raw('concat(path,",",id) as paths'))->orderBy('paths','asc')->get();
        // $sql ="select *,concat(path,',',id) as paths from cates order by  paths asc";
        // $cate = DB::select($sql);
        foreach ( $cate as $k => $v ) {
            $n = substr_count($v -> path, ',');//统计,出现的次数
            $s = str_repeat('|----', $n).$v -> cname;//处理分类名称
            //赋值
            $cate[$k] -> cname = $s;           
        }
        return $cate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $search = $request -> input('search','');
          $counts = Articles::count();
        // dump($search);
        //分页
        $articles = Articles::where('title','like','%'.$search.'%') ->orderBy('cate_id','asc') -> paginate(10);
        //分类名称加|--;
        foreach($articles as $k=>$v){
                $n = substr_count($v->articlescates -> path, ',');//统计,出现的次数
                $s = str_repeat('|----', $n).$v->articlescates -> cname;//处理分类名称
                //赋值
               $v->articlescates -> cname = $s;   
        }
       //加载文件模块
       return view('admin.articles.index',['articles' => $articles,'search' => $search,'counts' => $counts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //加载模版
        return view('admin.articles.add',['cate' => self::getCates()]);
        
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
        //传入数据库
        $articles = new Articles;
        $articles -> title = $request -> input('title');
        $articles -> descripition = $request -> input('descripition');
        $articles -> editor = $request -> input('editor');
        $articles -> cate_id = $request -> input('cate_id');
        $articles -> content = $request -> input('content');
        $res = $articles -> save();
        if($res){
            return redirect('/admin/articles')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
       return view('admin.articles.show');
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
        return view('admin.articles.edit',['data' => $data,'cate' => self::getCates()]);
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
        //传入数据库
        $articles = Articles::find($id);
        $articles -> title = $request -> input('title');
        $articles -> descripition = $request -> input('descripition');
        $articles -> editor = $request -> input('editor');
        $articles -> cate_id = $request -> input('cate_id');
        $articles -> content = $request -> input('content');
        $res = $articles -> save();
        // dd($res);
        if($res){
            return redirect('/admin/articles') -> with('success','删除成功');
        }else{
            return back() -> with('error','删除失败');
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
        $res = $articles -> forceDelete();
        //返回模版
         if($res){
            return back() -> with('success','永久删除成功');
        }else{
            return back() -> with('error','永久删除失败');
        }
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
        $counts = Articles::onlyTrashed()
                 -> where('title','like','%'.$search.'%')
                 -> count();
        //加载模版
        return view('admin.articles.restore',['articles' => $articles,'search' => $search,'counts' => $counts]);
    }

    public function restore($id)
    {   
        //恢复软删除数据
         $res = Articles::withTrashed()
                  -> where('id',$id)
                  -> restore();
        //返回模版
        if($res){
            return back() -> with('success','恢复成功');
        }else{
            return back() -> with('error','恢复失败');
        }
   
    }
}

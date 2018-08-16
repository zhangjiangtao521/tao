<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Cate;
use DB;
use App\Http\Controllers\Controller;

class CateController extends Controller
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
        //搜索
       $search = $request -> input('search','');
       //总和
       $counts = Cate::count();
        //分页
          $cate = Cate::select('*',DB::raw('concat(path,",",id) as paths'))->where('cname','like','%'.$search.'%')->orderBy('paths','asc')->paginate(10);
        foreach ( $cate as $k => $v ) {
            $n = substr_count($v -> path, ',');//统计,出现的次数
            $s = str_repeat('|----', $n).$v -> cname;//处理分类名称
            //赋值
            $cate[$k] -> cname = $s;         
        }
       
        return view('admin.cate.index',['cate' => $cate,'counts' => $counts,'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.cate.add',['cate' => self::getCates()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
         
        // dd($request -> all());
        //接受父级的id
        $pid = $request -> input('pid');
        $cate = new Cate;
        $cate -> cname = $request -> cname ;
        $cate -> pid = $pid;
        if($pid == 0){
            //顶级分类
            $cate -> path = $pid;
        }else{

            //处理路径
            $parent_data = Cate::find($pid);//查询父类的ID
            $cate -> path = $parent_data -> path.','.$parent_data -> id;
        }
        //添加
        if($cate -> save()){
            return redirect('admin/cate') -> with('success','添加成功');
        }else{
             return back() -> with('error','添加失败');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $cate = Cate::find($id);    
        return view('admin.cate.edit',['cate' => $cate,'data' => self::getCates()]);
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

        //接受修改的数据
        //  $data = $request -> all();
        // dd($data);
         //当前类别下是否是子分类
         $parent = Cate::where('pid',$id)->first();
         if(!empty($parent)){
            return back()->with('error','当前类别下有子分类,不允许修改');
            exit;
         }
         //接受父级的id
        $pid = $request -> input('pid');
        $cate = Cate::find($id);
        $cate -> cname = $request -> cname ;
        $cate -> pid = $pid;
        if($pid == 0){
            //顶级分类
            $cate -> path = $pid;
        }else{

            //处理路径
            $parent_data = Cate::find($pid);//查询父类的ID
            $cate -> path = $parent_data -> path.','.$parent_data -> id;
        }
        //修改
        if($cate -> save()){
            return redirect('admin/cate')->with('success','修改成功');
        }else{
             return back()->with('error','修改失败');
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
        //
       //当前类别下是否是子分类
         $parent = Cate::where('pid',$id)->first();
         if(!empty($parent)){
            return back()->with('error','当前类别下有子分类,不允许删除');
            exit;
         }
          if(Cate::destroy($id)){
            return redirect('admin/cate')->with('success','删除成功');
        }else{
             return back()->with('error','删除失败');
        }
    }
}

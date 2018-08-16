<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Link;
use DB;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request -> input('search','');
        // 获取数据
        $data = Link::where('linkname','like','%'.$search.'%')->paginate(10);
        return view('admin.link.index',['title'=>'显示友情链接','data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载模板
        return view('admin.link.create',['title'=>'添加友情链接']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 插入到数据库
        $blog = new Link;
        $blog -> linkname = $request->input('linkname');
        $blog -> linkurl = $request->input('linkurl');
        $res = $blog->save();
        if($res){
            return redirect('/admin/link')->with('success','添加成功');
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
        $link = Link::find($id);

        return view('admin.link.edit',['title'=>'修改友情链接','link'=>$link]);
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
        $blog = Link::find($id);
        $blog -> linkname = $request->input('linkname');
        $blog -> linkurl = $request->input('linkurl');
        $res = $blog->save();
        if($res){
            return redirect('/admin/link')->with('success','修改成功');
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
        $res = Link::destroy($id);
        if($res){
            return redirect('/admin/link')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}

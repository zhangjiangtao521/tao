<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        //搜索
         $search = $request -> input('search','');
         //总结
          $counts = comment::count();
        // dump($search);
        //分页
        $comment = Comment::where('art_id','like','%'.$search.'%')->paginate(10);
        return view('admin.comment.index',['comment' => $comment,'counts' => $counts,'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除
         if(Comment::destroy($id)){
            return redirect('/admin/comment') -> with('success','删除成功');
        }else{
            return back() -> with('error','删除失败');
        }
    }

    //禁用
    public function up($id,$status=2)
    {
         // $data['status']=$status;
         // dd($status);
         $comment = Comment::find($id);
         // dd($id.'----------'.$status.'----------'.$comment);
         $comment -> status = $status;
         $comment -> save();
         // orders::update($data,['id'=>$id],true);
         return redirect('/admin/comment');
    }

    //激活
     public function down($id)
    {       
        //两个方法
         return $this->up($id,1);
      // return action('admin/GoodsController/up',['id'=>$id,'status'=>3]);
    }

    //批量删除
    public function delete(Request $request)
    {   
       $id = $request ->input('id') ;
       // dump($id);
         $res = Comment::destroy($id);
       if($res){
        echo 'success';
       }else{
        echo 'error';
       }
    }
}

@extends('admin.layout.index')

@section('container')
 <fieldset class="layui-elem-field layui-field-title site-title">
    <legend><a name="default">文章统计</a></legend>
 </fieldset>
<!-- 搜索开始 -->
  <form class="layui-form" action="/admin/articles" method="get" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="layui-form-pane" style="text-align: center;">
      <div class="layui-form-item" >
        <div class="layui-input-inline">
          <input type="text" name="search"  placeholder="请输入文章标题" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-input-inline" style="width:50px" lay-submit="" lay-filter="sreach">
            <input type="submit" value="&#xe615;"  class="layui-btn layui-icon">
        </div>
      </div>
    </div> 
</form>
<!-- 搜索结束 -->

<!-- 内容开始 -->
<a href="/admin/articles/create"><button class="layui-btn"><i class="layui-icon">&#xe608;</i>添加</button></a>
 <a href="/admin/articles/resyde"><button class="layui-btn layui-btn-normal">回收站</button></a>
<table class="layui-table" style="width:1200px" >
    <thead>
        <tr>
            <th>文章ID</th>
            <th>文章标题</th>
            <th>文章描述</th>
            <th>缩放图</th>
            <th>作者</th>
            <th>浏览次数</th>
            <th>分类ID</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($articles as $k=>$v)
        <tr>
            <th>{{ $v->id }}</th>
            <th>{{ $v->title }}</th>
            <th>{{ $v->descripition }}</th>
            <th>
                <img src=" {{ $v->thumb }}" alt="" width="60">
            </th>
            <th>{{ $v->editor }}</th>
            <th>{{ $v->view }}</th>
            <th>{{ $v->cate_id }}</th>
            <th>
                 <a href="/admin/articles/{{ $v->id }}/edit"><button class="layui-btn layui-btn-warm">修改</button></a>
                <form action="/admin/articles/{{ $v->id }}" method="post" style="display:inline">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="submit" value="删除" class="layui-btn layui-btn-danger" >
                </form>
                <a href="/admin/articles/delete/{{ $v->id }}" ><button class="layui-btn  layui-btn-danger" onclick="return(confirm('您确定永久删除?'))">永久删除</button></a>
            </th>
        </tr>

    @endforeach
    </tbody>
</table>
<!-- 内容结束 -->
<div id='page_page'>
{!! $articles->appends(['search'=>$search])->render() !!}
</div>
@endsection
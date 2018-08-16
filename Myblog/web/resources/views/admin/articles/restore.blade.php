@extends('admin.layout.index')

@section('container')
 <fieldset class="layui-elem-field layui-field-title site-title">
    <legend><a name="default">文章回收站</a></legend>
</fieldset>
 <!-- 搜索开始 -->
  <form class="layui-form" action="/admin/articles/resyde" method="get" enctype="multipart/form-data">
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
<!-- 内容开始  -->
 <xblock>
     <a href="/admin/articles"><button class="layui-btn layui-btn-normal" onclick="member_add('添加用户','/admin/user/list','620','720')"><i class="layui-icon">&#xe613;</i> 文章列表</button></a>
    <span class="x-right" style="line-height:40px">共有数据：{{ $counts }} 条</span>
 </xblock>
<table class="layui-table" >
    <thead>
        <tr>
            <th>文章ID</th>
            <th>文章标题</th>
            <th>文章描述</th>
            <th>缩放图</th>
            <th>作者</th>
            <th>浏览次数</th>
            <th>分类ID</th>
            <th>删除时间</th>
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
            <th>{{ $v->deleted_at }}</th>
            <th>
                <a href="/admin/articles/restore/{{ $v->id }}"><button class="layui-btn layui-btn-small ">恢复</button></a>
            </th>
        </tr>
    @endforeach
    </tbody>
</table>
<!-- 内容结束 -->
<div id='page_page' style="text-align:center;">
{!! $articles->appends(['search'=>$search])->render() !!}
</div>
@endsection
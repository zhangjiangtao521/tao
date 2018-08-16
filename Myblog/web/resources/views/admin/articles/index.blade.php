@extends('admin.layout.index')

@section('container')
 <fieldset class="layui-elem-field layui-field-title site-title">
    <legend><a name="default">文章列表</a></legend>
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
 <xblock>
    <!-- <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button> -->
    <a href="/admin/articles/create"><button class="layui-btn" onclick="member_add('添加用户','/admin/cate/add','620','720')"><i class="layui-icon">&#xe608;</i> 添加</button></a>

    <a href="/admin/articles/resyde"><button class="layui-btn layui-btn-normal" onclick="member_add('添加用户','/admin/user/list','620','720')"><i class="layui-icon">&#xe640;</i> 回收站</button></a>
    <span class="x-right" style="line-height:40px">共有数据：{{ $counts }} 条</span>
 </xblock>
<table class="layui-table">
    <thead>
        <tr>
            <th>文章ID</th>
            <th>所属类别</th>
            <th>文章标题</th>
            <th>作者</th>
            <th>文章描述</th>
            <th>浏览次数</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($articles as $k=>$v)
        <tr>
            <td>{{ $v->id }}</td>
            <td>{{ $v->articlescates->cname }}</td>
            <td>{{ $v->title }}</td>
            <td>{{ $v->editor }}</td>
            <td>{{ $v->descripition }}</td>
            <td>{{ $v->view }}</td>
            <td>
                 <a href="/admin/articles/{{ $v->id }}"><button class="layui-btn layui-btn-small layui-btn-normal ">内容详情</button></a>
                 <a href="/admin/articles/{{ $v->id }}/edit"><button   class="layui-btn layui-btn-small layui-btn-warm ">修改</button></a>
                <form action="/admin/articles/{{ $v->id }}" method="post" style="display:inline">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="submit" value="删除" onclick="return(confirm('您确定删除吗?'))" class="layui-btn layui-btn-small layui-btn-danger " >
                </form>
                <a href="/admin/articles/delete/{{ $v->id }}" ><button class="layui-btn layui-btn-small layui-btn-danger " onclick="return(confirm('您确定永久删除吗?'))">永久删除</button></a>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>
<!-- 内容结束 -->
<div id='page_page' style="text-align:center;">
{!! $articles->appends(['search'=>$search])->render() !!}
</div>
@endsection
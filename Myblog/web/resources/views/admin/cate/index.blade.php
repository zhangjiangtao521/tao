@extends('admin.layout.index')

@section('container')

<!-- @if(Session::has("success"))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>成功!</strong> {{Session::get('success')}}
    </div>
@endif
失败提示框
@if(Session::has("error"))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>失败!</strong> {{Session::get('error')}}
    </div>
@endif -->
<!-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif -->

 <fieldset class="layui-elem-field layui-field-title site-title">
    <legend><a name="default">分类列表</a></legend>
 </fieldset>
<!-- 搜索开始 -->
  <form class="layui-form" action="/admin/cate" method="get" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="layui-form-pane" style="text-align: center;">
      <div class="layui-form-item" >
        <div class="layui-input-inline">
          <input type="text" name="search"  placeholder="请输入分类名字" autocomplete="off" class="layui-input">
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
    <a href="/admin/cate/create"><button class="layui-btn" onclick="member_add('添加用户','/admin/cate/add','620','720')"><i class="layui-icon">&#xe608;</i> 添加</button></a>

    <!-- <a href=""><button class="layui-btn layui-btn-normal" onclick="member_add('添加用户','/admin/user/list','620','720')"><i class="layui-icon">&#xe640;</i> 回收站</button></a> -->
    <span class="x-right" style="line-height:40px">共有数据：{{ $counts }} 条</span>
 </xblock>
<table class="layui-table">
  <thead>
      <tr>
          <th>分类ID</th>
          <th>分类名字</th>
          <th>分类的父类</th>
          <th>分类路径</th>
          <th>状态</th>
          <th>操作</th>
      </tr>
  </thead>
  <tbody>
  @foreach($cate as $k=>$v)
      <tr>
          <td>{{ $v->id }}</td>
          <td>{{ $v->cname }}</td>
          <td>{{ $v->pid }}</td>
          <td>{{ $v->path }}</td>
          <td>{{ $v->status == 1 ?  '激活' : '未激活'}}</td>
          <td>
               <a href="/admin/cate/{{ $v->id }}/edit"><button class="layui-btn layui-btn-small layui-btn-warm ">修改</button></a>
              <form action="/admin/cate/{{ $v->id }}" method="post" style="display:inline">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <input type="submit" value="删除" onclick="return(confirm('请慎重删除!!!'))"class="layui-btn layui-btn-small layui-btn-danger ">
              </form>
             <!--  <a href="/admin/articles/delete/{{ $v->id }}" ><button class="layui-btn  layui-btn-danger" onclick="return(confirm('您确定永久删除?'))">永久删除</button></a> -->
          </td>
      </tr>

  @endforeach
  </tbody>
</table>
<!-- 内容结束 -->
<div id='page_page' style="text-align:center;">
{!! $cate->appends(['search'=>$search])->render() !!}
</div>
@endsection
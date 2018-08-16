@extends('admin.layout.index')

@section('container')
 <fieldset class="layui-elem-field layui-field-title site-title">
       <legend><a name="default">分类修改</a></legend>
 </fieldset>
<form class="layui-form layui-form-pane" action="/admin/cate/{{ $cate->id }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
     {{ method_field('PUT') }}
      <div class="layui-form-item">
         <div class="layui-inline">
          <label class="layui-form-label" style="width:100px">分类名称</label>
          <div class="layui-input-inline">
            <input type="text" name="cname"  autocomplete="off" placeholder="请输入..." class="layui-input" style="width:300px" value="{{ $cate->cname }}">
          </div>
         </div>
     </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:100px">所选类别</label>
        <div class="layui-input-inline" style="width:300px">
          <select name="pid" >
            <option value="">请选择</option>
            @foreach( $data as $k=>$v) 
            <option value="{{ $v->id }}" @if($cate->pid == $v->id)  selected @endif>{{ $v->cname }}</option>
            @endforeach
          </select>
        </div>
     </div>
     <div class="layui-form-item">
         <button class="layui-btn" lay-submit="" lay-filter="demo2">提交</button>
     </div>
</form>
@endsection
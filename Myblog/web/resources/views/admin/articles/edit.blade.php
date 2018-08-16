@extends('admin.layout.index')


@section('container')
 <fieldset class="layui-elem-field layui-field-title site-title">
       <legend><a name="default">文章修改</a></legend>
 </fieldset>
<form class="layui-form layui-form-pane" action="/admin/articles/{{ $data->id }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:100px">分类ID</label>
        <div class="layui-input-inline">
          <select name="cate_id">
            <option value="">请选择</option>
            @foreach($cate as $k=>$v)
            <option value="{{ $v->id }}" @if ($data->cate_id == $v->id) selected @endif>{{ $v->cname }}</option>
            @endforeach
          </select>
        </div>
     </div>
     <div class="layui-form-item">
         <div class="layui-inline">
          <label class="layui-form-label" style="width:100px">文章标题</label>
          <div class="layui-input-inline">
            <input type="text" name="title" autocomplete="off" placeholder="请输入..." class="layui-input" value="{{ $data->title }}">
          </div>
        </div>
         <div class="layui-inline">
          <label class="layui-form-label" style="width:100px">作者</label>
          <div class="layui-input-inline">
            <input type="text" name="editor"  autocomplete="off" placeholder="请输入..." class="layui-input"   value="{{ $data->editor }}">
          </div>
         </div>
         
     </div>
     <div class="layui-form-item">
          <label class="layui-form-label" style="width:100px">文章描述</label>
          <div class="layui-input-inline">
            <input type="text" name="descripition" autocomplete="off" placeholder="请输入..." class="layui-input"  style="width:535px" value="{{ $data->descripition }}">
          </div>
     </div>
     <div class="layui-form-item layui-form-text">
        <label class="layui-form-label" style="width:900px;">发表文章</label>
        <div class="layui-input-block">
            <!-- 加载编辑器的容器 -->
          <script id="container" name="content" type="text/plain"  style="width:898px;height:300px">{{ $data->content }}
          </script>
        </div>
     </div>

     <div class="layui-form-item">
         <button class="layui-btn" lay-submit="" lay-filter="demo2">提交</button>
     </div>
    
</form>

@endsection
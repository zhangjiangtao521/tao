@extends('admin.layout.index')

@section('container')
 <fieldset class="layui-elem-field layui-field-title site-title">
       <legend><a name="default">文章统计</a></legend>
 </fieldset>
<form class="layui-form layui-form-pane" action="/admin/articles" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:100px">分类ID</label>
        <div class="layui-input-inline">
          <select name="cate_id">
            <option value="">请选择</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
        </div>
         <div class="layui-inline">
          <label class="layui-form-label" style="width:100px">文章标题</label>
          <div class="layui-input-inline">
            <input type="text" name="title" autocomplete="off" placeholder="请输入..." class="layui-input">
          </div>
        </div>
     </div>
     <div class="layui-form-item">
         <div class="layui-inline">
          <label class="layui-form-label" style="width:100px">作者</label>
          <div class="layui-input-inline">
            <input type="text" name="editor"  autocomplete="off" placeholder="请输入..." class="layui-input">
          </div>
         </div>
         <div class="layui-inline">
            <label class="layui-form-label" style="width:100px">图片</label>
            <div class="layui-input-inline">
              <input type="file" name="thumb" lay-verify="required" placeholder="请输入..." autocomplete="off" class="layui-input">
            </div>
        </div>
     </div>
     <div class="layui-form-item">
          <label class="layui-form-label" style="width:100px">文章描述</label>
          <div class="layui-input-inline">
            <input type="text" name="descripition" autocomplete="off" placeholder="请输入..." class="layui-input"  style="width:500px">
          </div>
     </div>
     <div class="layui-form-item layui-form-text">
        <label class="layui-form-label" style="width:900px;">发表文章</label>
        <div class="layui-input-block">
          <textarea placeholder="请输入内容..." name="content" class="layui-textarea" style="width:900px;height:300px"></textarea>
        </div>
     </div>

     <div class="layui-form-item">
         <button class="layui-btn" lay-submit="" lay-filter="demo2">提交</button>
     </div>
    }
</form>
@endsection
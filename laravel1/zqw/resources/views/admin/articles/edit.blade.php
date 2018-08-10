@extends('admin.layout.index')

@section('container')
<!--  <fieldset class="layui-elem-field layui-field-title site-title">
              <legend><a name="default">文章统计</a></legend>
            </fieldset>
    <form class="layui-form" action="/admin/articles/{{ $data->id }}" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label for="email" class="layui-form-label">
                <span class="x-red">*</span>文章标题
            </label>
            <div class="layui-input-inline">
                <input type="text" id="email" name="title" required="" 
                autocomplete="off" class="layui-input" value="{{ $data->title }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="email" class="layui-form-label">
                <span class="x-red">*</span>文章描述
            </label>
            <div class="layui-input-inline">
                <input type="text" id="email" name="descripition" required="" 
                autocomplete="off" class="layui-input" value="{{ $data->descripition }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="thumb" class="layui-form-label">
                <span class="x-red">*</span>缩放图
            </label>
            <div class="layui-input-inline">
                <input type="file" id="thumb" name="thumb" required="" 
                autocomplete="off" class="layui-input" value="{{ $data->thumb }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="thumb" class="layui-form-label">
                <span class="x-red">*</span>原图片
            </label>
            <div class="layui-input-inline">
                 <img src=" {{ $data->thumb }}" alt="" width="80">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="email" class="layui-form-label">
                <span class="x-red">*</span>作者
            </label>
            <div class="layui-input-inline">
                <input type="text" id="email" name="editor" required="" 
                autocomplete="off" class="layui-input" value="{{ $data->editor }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="email" class="layui-form-label">
                <span class="x-red">*</span>分类ID
            </label>
            <div class="layui-input-inline">
                <input type="text" id="email" name="cate_id" required="" 
                autocomplete="off" class="layui-input" value="{{ $data->view }}">
            </div>
        </div>
         <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">发表文章</label>
            <div class="layui-input-block">
              <textarea name="content" placeholder="请输入内容" required=""  class="layui-textarea" ></textarea>
            </div>
          </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <input type="submit" value="提交" class="layui-btn">
        </div>
</form> -->
<!-- 
@extends('admin.layout.index') -->

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
            <option value="0" @if ($data->cate_id == '0') selected @endif>0</option>
            <option value="1" @if ($data->cate_id == '1') selected @endif>1</option>
            <option value="2" @if ($data->cate_id == '2') selected @endif>2</option>
            <option value="3" @if ($data->cate_id == '3') selected @endif>3</option>
          </select>
        </div>
         <div class="layui-inline">
          <label class="layui-form-label" style="width:100px">文章标题</label>
          <div class="layui-input-inline">
            <input type="text" name="title" autocomplete="off" placeholder="请输入..." class="layui-input" value="{{ $data->title }}">
          </div>
        </div>
     </div>
     <div class="layui-form-item">
         <div class="layui-inline">
          <label class="layui-form-label" style="width:100px">作者</label>
          <div class="layui-input-inline">
            <input type="text" name="editor"  autocomplete="off" placeholder="请输入..." class="layui-input"   value="{{ $data->editor }}">
          </div>
         </div>
         <div class="layui-inline">
            <label class="layui-form-label" style="width:100px">图片</label>
            <div class="layui-input-inline">
              <input type="file" name="thumb" lay-verify="required" placeholder="请输入..." autocomplete="off" class="layui-input" value="{{ $data->thumb }}">
            </div>
        </div>
     </div>
     <div class="layui-form-item">
          <label class="layui-form-label" style="width:100px">文章描述</label>
          <div class="layui-input-inline">
            <input type="text" name="descripition" autocomplete="off" placeholder="请输入..." class="layui-input"  style="width:500px" value="{{ $data->descripition }}">
          </div>
     </div>
     <div class="layui-form-item layui-form-text">
        <label class="layui-form-label" style="width:900px;">发表文章</label>
        <div class="layui-input-block">
          <textarea placeholder="请输入内容..." name="content" class="layui-textarea" style="width:900px;height:300px">{{ $data->content }}</textarea>
        </div>
     </div>

     <div class="layui-form-item">
         <button class="layui-btn" lay-submit="" lay-filter="demo2">提交</button>
     </div>
    }
</form>

@endsection
@extends('admin.layout.index')

@section('container')
 <fieldset class="layui-elem-field layui-field-title site-title">
       <legend><a name="default">文章内容展示</a></legend>
 </fieldset>
 <xblock>
     <a href="/admin/articles"><button class="layui-btn layui-btn-normal" onclick="member_add('添加用户','/admin/user/list','620','720')"><i class="layui-icon">&#xe613;</i> 文章列表</button></a>
    <span class="x-right" style="line-height:40px">共有数据：1 条</span>
 </xblock>
  
    <h1>前台文章详情粘贴过来</h1>
    <!--  <div class="layui-form-item layui-form-text">
        <label class="layui-form-label" style="width:900px;">发表文章</label>
        <div class="layui-input-block">
           <!-- 加载编辑器的容器 -->
          <!-- <script id="container" name="content" type="text/plain"  style="width:900px;height:300px">
          </script>
        </div> -->
     <!-- </div> --> 


@endsection
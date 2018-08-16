@extends('admin.layout.index')

@section('container')
<blockquote class="layui-elem-quote">
    注意：x-admin 1.1每个页面都可以独立设置一个背景主题，如果每个都设置会比较消耗本地的存储，如果想全部恢复，请重置。
</blockquote>
<blockquote class="layui-elem-quote">
    欢迎使用x-admin 后台模版！
    <span class="f-14">v1.0</span>
    官方交流群： 519492808
</blockquote>
<fieldset class="layui-elem-field layui-field-title site-title">
    <legend><a name="default">{{ $title }}</a></legend>
</fieldset>
    <!-- 中部开始 -->
    <div class="wrapper">
        <!-- 右侧主体开始 -->
        <div class="page-content">
          <div class="content">
            <!-- 右侧内容框架，更改从这里开始 -->
            <form class="layui-form" action="/admin/link" method="post">
                {{ csrf_field() }}
                <div class="layui-form-item">
                    <label for="L_username" class="layui-form-label">
                        <span class="x-red">*</span>链接名称
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_username" name="linkname" required="" la/d-verify="nikename"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_username" class="layui-form-label">
                        <span class="x-red">*</span>链接地址
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" name="linkurl" required="" lay-verify="nikename"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" lay-filter="add" lay-submit="">
                        增加
                    </button>
                </div>
            </form>
            <!-- 右侧内容框架，更改从这里结束 -->
          </div>
        </div>
        <!-- 右侧主体结束 -->
    </div>
    <!-- 中部结束 -->
@endsection
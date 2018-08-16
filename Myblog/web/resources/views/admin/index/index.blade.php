@extends('admin/layout/index')

<!-- 在占位符中填充内容 -->
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
@endsection
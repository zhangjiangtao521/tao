@extends('admin.layout.index')


<!-- 在占位符中填充内容 -->
@section('container')
	<div class="page-content">
          <div class="content">
            <!-- 右侧内容框架，更改从这里开始 -->
            <fieldset class="layui-elem-field layui-field-title site-title">
              <legend><a name="default">用户修改</a></legend>
            </fieldset>
            <form class="layui-form" action="/admin/user/update/{{$data->id}}" method="post">
				{{ csrf_field() }}
            	<div class="layui-form-item">
                    <label for="L_email" class="layui-form-label">
                        <span class="x-red">*</span>用户名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_email" name="username" value="{{ $data->username }}" required="" 
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>将会成为您唯一的登入名
                    </div>
                </div>

				<div class="layui-form-item">
                    <label for="L_email" class="layui-form-label">
                        <span class="x-red">*</span>性别
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_email" name="sex" value="{{ $data->sex }}" required="" 
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>请输入男or女
                    </div>
                </div>

				<div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_pass" value="{{ $data->password }}" name="password" required="" lay-verify="password"
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        *6到16个字符
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="L_email" class="layui-form-label">
                        <span class="x-red">*</span>电话
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_email" value="{{ $data->phone }}" name="phone" required="" 
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="L_email" class="layui-form-label">
                        <span class="x-red">*</span>邮箱
                    </label>
                    <div class="layui-input-inline">
                        <input type="email" id="L_email" value="{{ $data->email }}" name="email" required="" lay-verify="email"
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                    </div>
                </div>
                
                <!-- <div class="layui-form-item">
                    <label for="L_email" class="layui-form-label">
                        <span class="x-red">*</span>上传头像
                    </label>
                    <div class="layui-input-inline">
                        <input type="file" id="L_email" value="{{ $data->profile }}" name="profile" required="" 
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                    </div>
                </div> -->
                
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <a href="/admin/user/update/"><button  class="layui-btn" lay-filter="add" lay-submit="">
                        增加
                    </button></a>
                </div>
            </form>
            <!-- 右侧内容框架，更改从这里结束 -->
          </div>
        </div>
@endsection
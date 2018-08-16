@extends('admin.layout.index')


<!-- 在占位符中填充内容 -->
@section('container')
<div class="page-content">
          <div class="content">
            <!-- 右侧内容框架，更改从这里开始 -->
            <fieldset class="layui-elem-field layui-field-title site-title">
              <legend><a name="default">用户恢复</a></legend>
            </fieldset>
            <form class="layui-form xbs" action="/admin/user/dellist" method="get" >
                <div class="layui-form-pane" style="text-align: center;">
                  <div class="layui-form-item" style="display: inline-block;">
                   <div class="layui-input-inline">
                      <input type="text" name="search" value="{{ $request['search'] or '' }}" placeholder="请输入用户名" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                  </div>
                </div> 
            </form>
            
            <xblock><!-- <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button> -->
                <a href="/admin/user/add"><button class="layui-btn" onclick="member_add('添加用户','/admin/user/add','620','720')"><i class="layui-icon">&#xe608;</i> 添加</button></a>

                <a href="/admin/user/list"><button class="layui-btn layui-btn-normal" onclick="member_add('添加用户','/admin/user/list','620','720')"><i class="layui-icon">&#xe613;</i> 用户列表</button></a>
                
                <span class="x-right" style="line-height:40px">共有数据：{{ $count }} 条</span></xblock>

            <table class="layui-table">
                <thead>
                    <tr>
                        <!-- <th>
                            <input type="checkbox" name="" value="">
                        </th> -->
                        <th>
                            ID
                        </th>
                        <th>
                            用户名
                        </th>
                        <th>
                            头像
                        </th>
                        <th>
                            性别
                        </th>
                        <th>
                            手机
                        </th>
                        <th>
                            邮箱
                        </th>
                        <th>
                            加入时间
                        </th>
                        <!-- <th>
                            状态
                        </th> -->
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deldata as $k=>$v)
                    <tr>
                        <!-- <td>
                            <input type="checkbox" value="1" name="">
                        </td> -->
                        <td>
                            {{ $v->id }}
                        </td>
                        <td>
                            <u style="cursor:pointer" onclick="member_show('张三','member-show.html','10001','360','400')">
                                {{ $v->username }}
                            </u>
                        </td>
                        <td >
                            {{ $v->profile }}
                        </td>
                        <td >
                            {{ $v->sex }}
                        </td>
                        <td >
                            {{ $v->phone }}
                        </td>
                        <td >
                            {{ $v->email }}
                        </td>
                        
                        <td>
                            {{ $v->created_at }}
                        </td>
                        
                        <td class="td-manage">
                            <a style="text-decoration:none" onclick="member_stop(this,'10001')" href="/admin/user/rollback/{{ $v->id }}" title="恢复">
                                <i class="layui-icon">&#xe601;</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- 分页 -->
            <div class="pagination" style="text-align:center;">
                {!! $deldata->render() !!}
            </div>
            
            <!-- 右侧内容框架，更改从这里结束 -->
          </div>
        </div>
        
@endsection
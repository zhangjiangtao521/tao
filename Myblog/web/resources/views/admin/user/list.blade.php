@extends('admin.layout.index')


<!-- 在占位符中填充内容 -->
@section('container')
<div class="page-content">
          <div class="content">
            <!-- 右侧内容框架，更改从这里开始 -->
            <fieldset class="layui-elem-field layui-field-title site-title">
              <legend><a name="default">用户列表</a></legend>
            </fieldset>
            <form class="layui-form xbs" action="/admin/user/list" method="get" >
                <div class="layui-form-pane" style="text-align: center;">
                  <div class="layui-form-item" style="display: inline-block;">
                    <label class="layui-form-label xbs768">搜索条数</label>
                    <div class="layui-input-inline xbs768">
                        <select name="count">
                            <option value="2" @if(!empty($request['count']) && isset($request['count']) == 2) selected @endif>2</option>
                            <option value="5" @if(!empty($request['count']) && isset($request['count']) == 5) selected @endif>5</option>
                            <option value="10" @if(!empty($request['count']) && isset($request['count']) == 10) selected @endif>10</option>
                        </select>
                    </div>
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

                <a href="/admin/user/dellist"><button class="layui-btn layui-btn-normal" onclick="member_add('添加用户','/admin/user/list','620','720')"><i class="layui-icon">&#xe640;</i> 回收站</button></a>
                
                <span class="x-right" style="line-height:40px">共有数据：{{ $counts }} 条</span></xblock>
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
                    @foreach ($data as $k=>$v)
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
                        <!-- <td class="td-status">
                            <span class="layui-btn layui-btn-normal layui-btn-mini">
                                已启用
                            </span>
                        </td> -->
                        <td class="td-manage">
                            
                            <a title="编辑" href="javascript:;" onclick="member_edit('编辑','member-edit.html','4','','510')"
                            class="ml-5" style="text-decoration:none">
                                <a href="/admin/user/updatelist/{{ $v->id }}"><i class="layui-icon">&#xe642;</i></a>
                            </a>
                            
                            <a title="删除" href="javascript:;" onclick="member_del(this,'1')" 
                            style="text-decoration:none">
                            <a href="/admin/user/delete/{{ $v->id }}"><i class="layui-icon">&#xe640;</i></a>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- 分页 -->
            <div class="pagination" style="text-align:center;">
                 <!-- {!! $data->render() !!} -->
                 {!! $data->appends($request)->render() !!}
            </div>
           

        
            <!-- 右侧内容框架，更改从这里结束 -->
          </div>

        </div>
        
@endsection
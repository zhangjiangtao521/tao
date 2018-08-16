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

 <!-- 右侧主体开始 -->
<div class="page-content">
  <div class="content">
    <!-- 右侧内容框架，更改从这里开始 -->
    <form class="layui-form xbs" action="/admin/link" method="get">
        <div class="layui-form-pane" style="text-align: center;">
          <div class="layui-form-item" style="display: inline-block;">
            <div class="layui-input-inline">
              <input type="text" name="search"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-input-inline" style="width:80px">
                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </div>
          </div>
        </div> 
    </form>
    <xblock><a href="/admin/link/create"><button class="layui-btn"><i class="layui-icon">&#xe608;</i>添加</button></a><span class="x-right" style="line-height:40px">共有数据：88 条</span></xblock>
    <table class="layui-table">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" name="" value="">
                </th>
                <th>
                    ID
                </th>
                <th>
                    友情链接名称
                </th>
                <th>
                    友情链接地址
                </th>
                <th>
                    创建时间
                </th>
                <th>
                    修改时间
                </th>
                <th>
                    状态
                </th>
                <th>
                    操作
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $k=>$v)
            <tr>
                <td>
                    <input type="checkbox" value="1" name="">
                </td>
                <td>
                    {{ $v->id }}
                </td>
                <td>
                    {{ $v->linkname }}
                </td>
                <td>
                    {{ $v->linkurl }}
                </td>
                <td>
                    {{ $v->created_at }}
                </td>
                <td>
                    {{ $v->updated_at }}
                </td>
                <td class="td-status">
                    <span class="layui-btn layui-btn-normal layui-btn-mini">
                        已启用
                    </span>
                </td>
                <td class="td-manage">
                    <a href="/admin/link/{{ $v->id }}/edit" class="layui-btn layui-btn-warm">修改</a>
                    <form action="/admin/link/{{ $v->id }}" method="post" style="display:inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="删除" title="删除" class="layui-btn layui-btn-danger" style="text-decoration:none">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 右侧内容框架，更改从这里结束 -->
  </div>
</div>
        <!-- 右侧主体结束 -->
        <script>

        layui.use(['laydate'], function(){
          laydate = layui.laydate;//日期插件

          //以上模块根据需要引入
          //
          

          
          var start = {
            min: laydate.now()
            ,max: '2099-06-16 23:59:59'
            ,istoday: false
            ,choose: function(datas){
              end.min = datas; //开始日选好后，重置结束日的最小日期
              end.start = datas //将结束日的初始值设定为开始日
            }
          };
          
          var end = {
            min: laydate.now()
            ,max: '2099-06-16 23:59:59'
            ,istoday: false
            ,choose: function(datas){
              start.max = datas; //结束日选好后，重置开始日的最大日期
            }
          };
          
          document.getElementById('LAY_demorange_s').onclick = function(){
            start.elem = this;
            laydate(start);
          }
          document.getElementById('LAY_demorange_e').onclick = function(){
            end.elem = this
            laydate(end);
          }
          
        });

        //批量删除提交
         function delAll () {
            layer.confirm('确认要删除吗？',function(index){
                //捉到所有被选中的，发异步进行删除
                layer.msg('删除成功', {icon: 1});
            });
         }
         /*用户-添加*/
        function member_add(title,url,w,h){
            x_admin_show(title,url,w,h);
        }
        /*用户-查看*/
        function member_show(title,url,id,w,h){
            x_admin_show(title,url,w,h);
        }

         /*用户-停用*/
        function member_stop(obj,id){
            layer.confirm('确认要停用吗？',function(index){
                //发异步把用户状态进行更改
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="layui-icon">&#xe62f;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-disabled layui-btn-mini">已停用</span>');
                $(obj).remove();
                layer.msg('已停用!',{icon: 5,time:1000});
            });
        }

        /*用户-启用*/
        function member_start(obj,id){
            layer.confirm('确认要启用吗？',function(index){
                //发异步把用户状态进行更改
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="layui-icon">&#xe601;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>');
                $(obj).remove();
                layer.msg('已启用!',{icon: 6,time:1000});
            });
        }
        // 用户-编辑
        function member_edit (title,url,id,w,h) {
            x_admin_show(title,url,w,h); 
        }
        /*密码-修改*/
        function member_password(title,url,id,w,h){
            x_admin_show(title,url,w,h);  
        }
        /*用户-删除*/
        function member_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //发异步删除数据
                $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:1000});
            });
        }
        </script>
        <script>
        //百度统计可去掉
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();

 
        </script>
@endsection

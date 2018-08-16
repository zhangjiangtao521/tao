@extends('admin.layout.index')

@section('container')
 <fieldset class="layui-elem-field layui-field-title site-title">
    <legend><a name="default">评论列表</a></legend>
 </fieldset>
<!-- 搜索开始 -->
  <form class="layui-form" action="/admin/comment" method="get" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="layui-form-pane" style="text-align: center;">
      <div class="layui-form-item" >
        <div class="layui-input-inline">
          <input type="text" name="search"  placeholder="请输入文章ID" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-input-inline" style="width:50px" lay-submit="" lay-filter="sreach">
            <input type="submit" value="&#xe615;"  class="layui-btn layui-icon">
        </div>
      </div>
    </div> 
</form>
<!-- 搜索结束 -->

<!-- 内容开始 -->
 <xblock>
    <a href="javascript:;" ><button class="layui-btn layui-btn-normal" style="background:red;"><i class="layui-icon">&#xe640;</i> 批量删除</button></a>
    <span class="x-right" style="line-height:40px">共有数据：{{ $counts }} 条</span>
 </xblock>
<table class="layui-table">
    <thead>
        <tr>
            <th>批量删除</th>
            <th>评论ID</th>
            <th>文章标题</th>
            <th>用户名</th>
            <th>评论内容</th>
            <th>状态</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($comment as $k=>$v)
        <tr>
            <td> <input type="checkbox" name="check[]" value=""></td>
            <td>{{ $v->id }}</td>
            <td>{{ $v->commentarticles->title }}</td>
            <td>{{ $v->commentuser->username }}</td>
            <td>{{ $v->info }}</td>
            <td>
                @if($v->status == 1)
                    激活
                @elseif($v->status ==2)
                    禁用
                @endif
            </td>
            <td>{{ $v->created_at }}</td>
            <td>
                @if($v->status == 1)
                    <a href="/admin/comment/up/{{ $v->id }}" class="layui-btn layui-btn-small layui-btn-warm">禁用</a>
                @elseif($v->status==2)
                    <a href="/admin/comment/down/{{ $v->id }}" class="layui-btn layui-btn-small ">激活</a>
                @endif 
                <form action="/admin/comment/{{ $v->id }}" method="post" style="display:inline" >
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" value="删除" class="layui-btn layui-btn-small layui-btn-danger" onclick="return(confirm('您确定删除吗?'))">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<!-- 内容结束 -->
<div id='page_page' style="text-align:center;">
{!! $comment->appends(['search'=>$search])->render() !!}
</div>
<script type="text/javascript">
    //ajax csrf
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        //点击批量删除
        $('button').eq(0).click(function(){
            var ids = [];       
            // 获取选择元素的id
            $('input:checked').parent().next().each(function(){
                var n = $(this).html();
                ids.push(n);
            });
            if(ids.length <= 0){
                alert('请选择要删除数据');
                return;
            }
            // alert(ids);
            $.post('/admin/comment/delete',{'id':ids},function(msg){
                // alert(msg);
                if(msg == 'success'){
                    // 移除选中的节点
                    $('table tr input:checked').parent().parent().remove();
                }else{
                    alert('删除失败');
                }
            },'html');
        }); 
</script>
@endsection
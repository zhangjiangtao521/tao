<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台登录-X-admin1.1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="/d/lib/layui/css/layui.css" media="all"> -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/d/css/font.css">
    <link rel="stylesheet" href="/d/css/xadmin.css">
    <link rel="stylesheet" href="/d/css/swiper.min.css">
	<link rel="stylesheet" href="/d/css/fenye.css">
    <script type="text/javascript" src="/d/js/jquery.min.js"></script>
    <script type="text/javascript" src="/d/js/swiper.jquery.min.js"></script>
    <script src="/d/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/d/js/xadmin.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 配置文件 -->
    <script type="text/javascript" src="/utf8-php/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/utf8-php/ueditor.all.js"></script>
</head>
<body>
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="/admin">博客首页</a></div>
        <div class="open-nav"><i class="iconfont">&#xe699;</i></div>
        <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">admin</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd><a href="">个人信息</a></dd>
                <dd><a href="">切换帐号</a></dd>
                <dd><a href="./login.html">退出</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item"><a href="/">前台首页</a></li>
        </ul>
    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
    <div class="wrapper">
        <!-- 左侧菜单开始 -->
        <div class="left-nav">
          <div id="side-nav">
            <ul id="nav">
                <li class="list" current>
                    <a href="/admin">
                        <i class="iconfont">&#xe761;</i>
                        欢迎页面
                        <i class="iconfont nav_right">&#xe697;</i>
                    </a>
                </li>
                <li class="list">
                    <a href="javascript:;">
                        <i class="iconfont">&#xe70b;</i>
                        会员管理
                        <i class="iconfont nav_right">&#xe697;</i>
                        
                    </a>
                    <ul class="sub-menu">
                        
                        <li>
                            <a href="/admin/user/list">
                                <i class="iconfont">&#xe6a7;</i>
                                用户列表
                            </a>
                        </li>
                        <li>
                            <a href="/admin/user/add">
                                <i class="iconfont">&#xe6a7;</i>
                                用户添加
                            </a>
                        </li>
                        <li>
                            <a href="/admin/user/dellist">
                                <i class="iconfont">&#xe6a7;</i>
                                用户恢复 
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="list">
                    <a href="javascript:;">
                        <i class="iconfont">&#xe70b;</i>
                        文章管理
                        <i class="iconfont nav_right">&#xe697;</i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="/admin/articles">
                                <i class="iconfont">&#xe6a7;</i>
                                文章列表
                            </a>
                        </li>
                        <li>
                            <a href="/admin/articles/create">
                                <i class="iconfont">&#xe6a7;</i>
                                文章添加
                            </a>
                        </li>
                        <li>
                            <a href="/admin/articles/resyde">
                                <i class="iconfont">&#xe6a7;</i>
                                文章恢复
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="list">
                    <a href="javascript:;">
                        <i class="iconfont">&#xe70b;</i>
                        友情链接
                        <i class="iconfont nav_right">&#xe697;</i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="/admin/link/create">
                                <i class="iconfont">&#xe6a7;</i>
                                添加链接
                            </a>
                        </li>
                        <li>
                            <a href="/admin/link">
                                <i class="iconfont">&#xe6a7;</i>
                                链接显示
                            </a>
                        </li>
                        <li>
                            <a href="member-list.html">
                                <i class="iconfont">&#xe6a7;</i>
                                回收站
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="list">
                    <a href="javascript:;">
                        <i class="iconfont">&#xe70b;</i>
                        分类管理
                        <i class="iconfont nav_right">&#xe697;</i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="/admin/cate">
                                <i class="iconfont">&#xe6a7;</i>
                                分类列表
                            </a>
                        </li>
                        <li>
                            <a href="/admin/cate/create">
                                <i class="iconfont">&#xe6a7;</i>
                                分类添加
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="list">
                    <a href="javascript:;">
                        <i class="iconfont">&#xe70b;</i>
                        评论管理
                        <i class="iconfont nav_right">&#xe697;</i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="/admin/comment">
                                <i class="iconfont">&#xe6a7;</i>
                                评论列表
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
          </div>
        </div>
        <!-- 左侧菜单结束 -->
        <!-- 右侧主体开始 -->
        <div class="page-content">
          <div class="content">
            <!-- 读取跳转信息 -->
               <!--  @if(session('success'))
                {{ session('success') }}
                @endif

                @if(session('error'))
                {{ session('error') }}
                @endif -->
            <!-- 右侧内容框架，更改从这里开始 -->
                @section('container')

                @show
            <!-- 右侧内容框架，更改从这里结束 -->
          </div>
        </div>
        <!-- 右侧主体结束 -->
    </div>
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    <div class="footer">
        <div class="copyright">Copyright ©2017 x-admin v2.3 All Rights Reserved. 本后台系统由X前端框架提供前端技术支持</div>  
    </div>
    <!-- 底部结束 -->
    <!-- 背景切换开始 -->
    <div class="bg-changer">
        <div class="swiper-container changer-list">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img class="item" src="/d/images/a.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/d/images/b.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/d/images/c.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/d/images/d.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/d/images/e.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/d/images/f.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/d/images/g.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/d/images/h.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/d/images/i.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/d/images/j.jpg" alt=""></div>
                <div class="swiper-slide"><img class="item" src="/d/images/k.jpg" alt=""></div>
                <div class="swiper-slide"><span class="reset">初始化</span></div>
            </div>
        </div>
        <div class="bg-out"></div>
        <div id="changer-set"><i class="iconfont">&#xe696;</i></div>   
    </div>
    <!-- 背景切换结束 -->
    <script>
    //百度统计可去掉
    // var _hmt = _hmt || [];
    // (function() {
    //   var hm = document.createElement("script");
    //   hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
    //   var s = document.getElementsByTagName("script")[0]; 
    //   s.parentNode.insertBefore(hm, s);
    // })();
    </script>
    <!-- 实例化编辑器 -->
 <script type="text/javascript">
    var ue = UE.getEditor('container', {
        zIndex : 100,// z轴 
        charset : 'utf-8',  // 字符编码
        textarea : 'newsContent',// 提交表单时的名称
    })
  </script>
</body>
</html>
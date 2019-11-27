<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 继承 -->
    <title>九州后台 - @yield('title')</title>

    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="apple-mobile-web-app-title" content="九州" />
    <link rel="icon" type="image/png" href="/Admin/assets/i/favicon.png">
    
    <!-- 继承重写 -->
    <link rel="apple-touch-icon-precomposed" href="/Admin/assets/i/app-icon72x72@2x.png">
    <link rel="stylesheet" href="/Admin/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="/Admin/assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="/Admin/assets/css/app.css">

    <script src="/plug/echarts.min.js"></script>
    <script src="/plug/jquery.min.js"></script>

    <script src="http://cdn.bootcss.com/echarts/3.3.2/echarts.min.js"></script>
    <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>

    @yield('css')


</head>

<body data-type="index">
    <script src="/Admin/assets/js/theme.js"></script>
    <div class="am-g tpl-g">
        <!-- 头部 -->
        <header>
            <!-- logo -->
            <div class="am-fl tpl-header-logo">
                <a href="javascript:;"><img src="/Admin/assets/img/logo.png" alt=""></a>
            </div>
            <!-- 右侧内容 -->
            <div class="tpl-header-fluid">
                <!-- 侧边切换 -->
                <div class="am-fl tpl-header-switch-button am-icon-list">
                    <span>

                </span>
                </div>
                <!-- 搜索 -->
                <div class="am-fl tpl-header-search">
                    <form class="tpl-header-search-form" action="javascript:;">
                        <button class="tpl-header-search-btn am-icon-search"></button>
                        <input class="tpl-header-search-box" type="text" placeholder="搜索内容...">
                    </form>
                </div>
                <!-- 其它功能-->
                <div class="am-fr tpl-header-navbar">
                    <ul>
                        <!-- 欢迎语 -->
                        <li class="am-text-sm tpl-header-navbar-welcome">
                            <a href="javascript:;">欢迎您, <span style='font-size:20px'>{{ session("adminInfo.name") }}</span> </a>
                        </li>

                        <!-- 新邮件 -->
                        <li class="am-dropdown tpl-dropdown" data-am-dropdown>
                            <a href="javascript:;" class="am-dropdown-toggle tpl-dropdown-toggle" data-am-dropdown-toggle>
                                <i class="am-icon-envelope"></i>
                                <span class="am-badge am-badge-success am-round item-feed-badge">4</span>
                            </a>
                            <!-- 弹出列表 -->
                            <ul class="am-dropdown-content tpl-dropdown-content">
                                <li class="tpl-dropdown-menu-messages">
                                    <a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">
                                        <div class="menu-messages-ico">
                                            <img src="/Admin/assets/img/user04.png" alt="">
                                        </div>
                                        <div class="menu-messages-time">
                                            3小时前
                                        </div>
                                        <div class="menu-messages-content">
                                            <div class="menu-messages-content-title">
                                                <i class="am-icon-circle-o am-text-success"></i>
                                                <span>夕风色</span>
                                            </div>
                                            <div class="am-text-truncate"> Amaze UI 的诞生，依托于 GitHub 及其他技术社区上一些优秀的资源；Amaze UI 的成长，则离不开用户的支持。 </div>
                                            <div class="menu-messages-content-time">2016-09-21 下午 16:40</div>
                                        </div>
                                    </a>
                                </li>

                                <li class="tpl-dropdown-menu-messages">
                                    <a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">
                                        <div class="menu-messages-ico">
                                            <img src="/Admin/assets/img/user02.png" alt="">
                                        </div>
                                        <div class="menu-messages-time">
                                            5天前
                                        </div>
                                        <div class="menu-messages-content">
                                            <div class="menu-messages-content-title">
                                                <i class="am-icon-circle-o am-text-warning"></i>
                                                <span>禁言小张</span>
                                            </div>
                                            <div class="am-text-truncate"> 为了能最准确的传达所描述的问题， 建议你在反馈时附上演示，方便我们理解。 </div>
                                            <div class="menu-messages-content-time">2016-09-16 上午 09:23</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="tpl-dropdown-menu-messages">
                                    <a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">
                                        <i class="am-icon-circle-o"></i> 进入列表…
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- 新提示 -->
                        <li class="am-dropdown" data-am-dropdown>
                            <a href="javascript:;" class="am-dropdown-toggle" data-am-dropdown-toggle>
                                <i class="am-icon-bell"></i>
                                <span class="am-badge am-badge-warning am-round item-feed-badge">5</span>
                            </a>

                            <!-- 弹出列表 -->
                            <ul class="am-dropdown-content tpl-dropdown-content">
                                <li class="tpl-dropdown-menu-notifications">
                                    <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                        <div class="tpl-dropdown-menu-notifications-title">
                                            <i class="am-icon-line-chart"></i>
                                            <span> 有6笔新的销售订单</span>
                                        </div>
                                        <div class="tpl-dropdown-menu-notifications-time">
                                            12分钟前
                                        </div>
                                    </a>
                                </li>
                                <li class="tpl-dropdown-menu-notifications">
                                    <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                        <div class="tpl-dropdown-menu-notifications-title">
                                            <i class="am-icon-star"></i>
                                            <span> 有3个来自人事部的消息</span>
                                        </div>
                                        <div class="tpl-dropdown-menu-notifications-time">
                                            30分钟前
                                        </div>
                                    </a>
                                </li>
                                <li class="tpl-dropdown-menu-notifications">
                                    <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                        <div class="tpl-dropdown-menu-notifications-title">
                                            <i class="am-icon-folder-o"></i>
                                            <span> 上午开会记录存档</span>
                                        </div>
                                        <div class="tpl-dropdown-menu-notifications-time">
                                            1天前
                                        </div>
                                    </a>
                                </li>


                                <li class="tpl-dropdown-menu-notifications">
                                    <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                        <i class="am-icon-bell"></i> 进入列表…
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- 退出 -->
                        <li class="am-text-sm">
                            <a href="/admin/logout/?id={{ session('adminInfo.id') }}">
                                <span class="am-icon-sign-out"></span> 退出
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </header>
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
        <!-- 侧边导航栏 -->
        <div class="left-sidebar">
            <!-- 用户信息 -->
            <div class="tpl-sidebar-user-panel">
                <div class="tpl-user-panel-slide-toggleable">
                    <div class="tpl-user-panel-profile-picture">
                        <img src="/Admin/assets/img/user04.png" alt="">
                    </div>
                    <span class="user-panel-logged-in-text">
              <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
              {{session('adminInfo.name')}}
          </span>
                    <a href="/admin/adminedit/?id={{session('adminInfo.id')}}" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
                </div>
            </div>

            <!-- 菜单 -->
            <ul class="sidebar-nav">

                <li class="sidebar-nav-link">
                    <a href="/admin" class="active">
                        <i class="am-icon-home sidebar-nav-link-logo"></i> 首页
                    </a>
                </li>

                <!-- 管理员模块 -->
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 后台管理员
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="/admin/adminlist">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 管理员列表
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="/admin/addAdmin">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加管理员
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- 结束 -->


                <!-- 前台会员模块 -->
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 前台用户
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="/admin/userlist">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 用户列表
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- 结束 -->


                <!-- 角色模块 -->
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 角色管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="/admin/roleslist">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 角色列表
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="/admin/addroles">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加角色
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- 结束 -->


                <!-- 权限模块 -->
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 权限管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="/admin/power">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 权限列表
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="/admin/addpower">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加权限
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- 结束 -->


                <!-- 分类模块 -->
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 分类管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="/admin/types">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 分类列表
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="/admin/types/add">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加顶级分类
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- 结束 -->


                <!-- 商品模块 -->
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 商品管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="/admin/goods">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 商品列表
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="/admin/goods/goodsAdd">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加商品
                            </a>
                        </li>
                        <li class="sidebar-nav-link">
                            <a href="/admin/specsItems">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 模型列表
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- 结束 -->


                <!-- 订单模块 -->
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-list-alt sidebar-nav-link-logo"></i> 订单管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="/admin/order">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 订单列表
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- 结束 -->


                <!-- 评论模块 -->
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-pencil-square-o sidebar-nav-link-logo"></i> 评论管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="/admin/comments">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 评论列表
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- 结束 -->



                <!-- 分类模块 -->
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 轮播图管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="/admin/lunbo">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 轮播图列表
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="/admin/doadd">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加轮播图
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- 结束 -->

                <!-- 友链模块 -->
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 友链管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="/admin/friend">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 友链列表
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="/admin/add">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 添加友链
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- 内容区域 重写 -->
        <div class="tpl-content-wrapper">
            @section('body')
                首页内容
            @show
        </div>
    </div>
    </div>


    <script src="/plug/amazeui.min.js"></script>

    <script src="/Admin/assets/js/amazeui.datatables.min.js"></script>
    <script src="/Admin/assets/js/dataTables.responsive.min.js"></script>
    <script src="/Admin/assets/js/app.js"></script>
    @yield('js')
</body>
</html>
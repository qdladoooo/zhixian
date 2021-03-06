<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title or "首页" }} - 知先生物数据管理系统</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- site css -->
    <link rel="stylesheet" href="/dist/css/site.min.css">
    <link rel="stylesheet" href="/statics/css/main.css">
    @yield('style')
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/dist/js/site.min.js"></script>
</head>
<body>
<!--nav-->
<nav role="navigation" class="navbar navbar-custom">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a href="#" class="navbar-brand">知先生物数据管理系统</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="bs-content-row-navbar-collapse-5" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="###">{{ session('login_user')['name'] }}</a></li>
                <li class="active"><a href="/user/logout">退出登录</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--header-->
<div class="container-fluid">
    <!--documents-->
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
            <ul class="list-group panel">
                <li>
                    <a href="#demo3" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-th"></i>数据管理  <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <div class="collapse in" id="demo3">
                        <a href="/sample" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-qrcode"></i>  录入(已完成)</a>
                        <a href="/sample/patient" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-search"></i>  查询(已完成)</a>
                        <a href="/sample/import" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-cloud-upload"></i>  导入</a>
                        <a href="javascript:;" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-cloud-download"></i>  导出</a>
                        <a href="javascript:;" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-exclamation-sign"></i>  删除</a>
                    </div>
                </li>
                <li>
                    <a href="#demo4" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-user"></i>用户管理  <span class="glyphicon glyphicon-chevron-right"></span></a>
                <li class="collapse" id="demo4">
                    <a href="javascript:;" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-qrcode"></i>  新增</a>
                    <a href="javascript:;" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-search"></i>  查询</a>
                    <a href="javascript:;" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-search"></i>  修改</a>
                    <a href="javascript:;" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-exclamation-sign"></i>  删除</a>
                </li>
                </li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-9 content" style="min-height: 500px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>侧边栏</h3>
                </div>
                <div class="panel-body">
                    @yield('content')
                </div><!-- panel body -->
            </div>
        </div><!-- content -->
    </div>
</div>
<!--footer-->
<div class="site-footer">
    <div class="container">
        <div class="copyright clearfix">
            Powered by 雨牙工作室
        </div>
    </div>
</div>
@yield('script')
</body>
</html>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title or "登录" }}</title>

    <script type="text/javascript" src="/statics/js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="/statics/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/statics/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/statics/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/statics/css/main.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<style type="text/css">
    body {
        background-image: url(/statics/img/login_bg.jpg);
        overflow: hidden;
    }
</style>
    <div class="admin_login_container">
        <div class="admin_login_title">知先后台系统</div>
        <form class="form-inline" role="form" method="post" id="form_admin_login">
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail">输入邮箱</label>
                <input type="email" class="form-control" id="exampleInputEmail" placeholder="输入邮箱">
            </div>
            <div class="form-group">
                <label class="sr-only" for="exampleInputPassword">输入密码</label>
                <input type="password" class="form-control" id="exampleInputPassword" placeholder="输入密码">
            </div>
            <div class="checkbox hide">
                <label>
                    <input type="checkbox"> 记住我
                </label>
            </div>
            <button type="submit" class="btn btn-default">进入</button>
        </form>
    </div>

<script>
    $().ready(function() {
        //获取url参数
        function parse(val) {
            var result = "",
                    tmp = [];
            location.search
                    //.replace ( "?", "" )
                    // this is better, there might be a question mark inside
                    .substr(1)
                    .split("&")
                    .forEach(function (item) {
                        tmp = item.split("=");
                        if (tmp[0] === val) result = decodeURIComponent(tmp[1]);
                    });
            return result;
        }

        $('#form_admin_login').on('submit', function() {
            var flag = true;
            if($('#exampleInputEmail').val() == '') {
                alert('请输入邮箱。');
                $('#exampleInputEmail').focus();
                flag = false;
            } else if($('#exampleInputPassword').val() == '') {
                alert('请输入密码。');
                $('#exampleInputPassword').focus();
                flag = false;
            }

            if(flag) {
                var email = $.trim( $('#exampleInputEmail').val() );
                var pw = $.trim( $('#exampleInputPassword').val() );
                var ciphertext = md5( md5(email) + md5(pw));
                var url = parse('url');
                $.ajax({
                    type: "POST",
                    url: "/user/login",
                    data: "email=" + email + "&cipher=" + ciphertext,
                    dataType: "json",
                    success: function(msg) {
                        if(msg.flag) {
                            location.href = "/sample";
//                            location.href = "/user?url=" + encodeURIComponent('/admin/activity/publish');
                        } else {
                            alert(msg.messages[0]);
                        }
                    }
                });
            }

            return false;
        });
    });
</script>

<script src="/statics/js/md5.js"></script>
</body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('script')
</html>



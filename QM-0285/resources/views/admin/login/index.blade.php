<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理员登录 - 媒体内容管理系统</title>
    <meta name="author" content="杨旭/Rouyi|http://www.qimaweb.com">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{asset('lib/js/jquery-1.7.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/cloud.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/js/jquery.placeholder.min.js')}}"></script>
    <script type="text/javascript">
        if(self != top) top.location = self.location;
        $(function() {
            $('input, textarea').placeholder();
        });
    </script>
</head>
<body class="login">

<div id="mainBody">
    <div id="cloud1" class="cloud"></div>
    <div id="cloud2" class="cloud"></div>
</div>

<div class="top">
    <span>欢迎登录媒体内容管理系统！</span>
    <ul>
        <li><a>回首页</a></li>
        <li><a>帮助</a></li>
        <li><a>关于</a></li>
    </ul>
</div>

<div class="body">
    <div class="logo"></div>
    <form action="{{url('admin/login')}}" method="post" autocomplete="off">
        {{csrf_field()}}
        <div class="login-box">
            <ul>
                <li><input name="username" type="text" class="input username" placeholder="请输入用户名" required minlength="4" maxlength="20"></li>
                <li><input name="password" type="password" class="input password" placeholder="请输入密码密码" required minlength="4" maxlength="20"></li>
                <li class="code">
                    <span><input name="code" type="text" placeholder="请输入验证码" class="input code-input" required></span>
                    <cite><img src="{{url('code/104/44/&')}}" onclick="this.src = '{{url('code/104/44/&')}}' + Math.random()"></cite>
                </li>
                <li>
                    <button type="submit" class="submit">登录</button>
                    <label><input name="" type="checkbox" value="" checked="checked" />记住密码</label>
                    <label><a onclick="alert('请联系技术！')">忘记密码？</a></label>
                </li>
            </ul>
        </div>
    </form>
</div>

<div class="bottom">
    <p>版权所有 &copy; {{date('Y')}} 北京利诺通网络科技有限公司 技术支持：<a href="http://www.eqitui.com.cn/" target="_blank">北京利诺通网络科技有限公司</a></p>
</div>

</body>
</html>

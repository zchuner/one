<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台首页</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{asset('lib/js/jquery-3.1.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/admin.js')}}"></script>
</head>
<body>

<div class="content">
    <div class="mainindex">
        <div class="welinfo">
            <span><img src="{{asset('admin/images/sun.png')}}" alt="天气" /></span>
            <b>{{getNickname()}} ({{getConfigRole($data['roleid'], 'rolename')}}) 你好，欢迎使用媒体内容管理系统</b>
            <a href="{{url('admin/extend?a=public_edit_info')}}">帐号设置</a>
        </div>
        <div class="welinfo">
            <span><img src="{{asset('admin/images/time.png')}}" alt="时间" /></span>
            <i>您上次登录的时间：{{date('Y-m-d H:i:s', $data['lastlogintime'])}}</i> （如果不是您登录的，请立即<a href="{{url('admin/extend?a=public_edit_pwd')}}" style="padding:0">修改密码</a>）
        </div>
        <div class="xline"></div>
        <ul class="icon-list">
            <li><a href="{{url('admin/home')}}"><img src="{{asset('admin/images/ico01.png')}}" /><p>系统首页</p></a></li>
            <li><a href="{{getExtendsUrl('?m=content&c=content&a=init')}}"><img src="{{asset('admin/images/ico02.png')}}" /><p>管理内容</p></a></li>
        </ul>
        <div class="ibox" style="padding-top:0"><!--<a class="ibtn"><img src="{{asset('admin/images/iadd.png')}}" />添加新的快捷功能</a>--></div>
        <div class="xline"></div>
        <div class="box"></div>
        <div class="welinfo">
            <span><img src="{{asset('admin/images/dp.png')}}" /></span>
            <b>系统使用指南</b>
        </div>
        <ul class="infolist">
            <li><span>您可以快速进行文章发布管理操作</span><a href="{{getExtendsUrl('?m=content&c=content&a=init')}}" class="ibtn">发布或管理内容</a></li>
            <li><span>您可以进行密码修改、账户设置等操作</span><a href="{{getExtendsUrl('?c=admin_manage&a=public_edit_info')}}" class="ibtn">账户管理</a></li>
        </ul>
        <div class="xline"></div>
        <div class="maker-info">
            <p><b>网站使用指南</b></p>
        </div>
        <ul class="umlist">
            <li><a href="{{getExtendsUrl('?m=content&c=content&a=init')}}">发布内容</a></li>
            <li><a href="{{url('')}}" target="_blank">网站首页</a></li>
            <li><a href="{{getExtendsUrl()}}">后台用户设置(权限)</a></li>
            <li><a href="{{getExtendsUrl('?c=site&a=init')}}">站点设置</a></li>
        </ul>
    </div>
</div>

</body>
</html>
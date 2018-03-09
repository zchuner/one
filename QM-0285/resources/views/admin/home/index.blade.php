<!-- 执行程序花费时间：{{getExecuteTime()}} -->
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>媒体内容管理系统 - 杨旭</title>
    <meta name="author" content="杨旭/Rouyi">
    <meta name="_token" content="{{csrf_token()}}" />
    <meta name="extend_url" content="{{getExtendsUrl()}}" />
    <link href="{{asset('admin/extends/css/dialog.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="{{asset('lib/js/jquery-1.7.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/admin.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/extends/js/admin_common.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/extends/js/dialog.js')}}"></script>
</head>
<body>

<div class="header">
    <div class="top-left">
        <a href="{{url('admin/home')}}" target="right">
            <img src="{{asset('admin/images/logo.png')}}" title="系统首页"/>
        </a>
    </div>

    <ul class="nav" id="top_menu">
        @foreach($menu as $v)
            @if($v['id'] == 10)
                <li class="active" id="_M{{$v['id']}}">
                    <a onclick="menu({{$v['id']}})">
                        <img src="{{asset('admin/images/menu-icon/' . $v['id'] . '.png')}}"/>
                        <h2>{{getLang($v['name'])}}</h2>
                    </a>
                </li>
            @else
                <li>
                    <a onclick="menu({{$v['id']}})">
                        <img src="{{asset('admin/images/menu-icon/' . $v['id'] . '.png')}}"/>
                        <h2>{{getLang($v['name'])}}</h2>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>

    <div class="top-right">
        <ul>
            <li><a href="{{getExtendsUrl('?c=cache_all&a=init')}}" target="right">更新缓存</a></li>
            <li><a href="{{getExtendsUrl('?m=content&c=create_html&a=public_index')}}" target="right">更新主页</a></li>
            <li><a href="{{url('')}}" target="_blank">网站首页</a></li>
            <li><a href="{{url('admin/logout')}}">退出登录</a></li>
        </ul>
        <div class="user">
            <span class="name">
                {{getNickname()}}
                ({{getConfigRole(session('admin')['roleid'], 'rolename')}})
            </span>
        </div>
    </div>
</div>

<div class="menu" id="Scroll">
    <div class="left-top"><span></span>操作菜单</div>
    <dl class="left-menu" id="leftMain"></dl>
</div>
<div class="menu" id="display_center_id" style="display:none">
    <div class="left-menu">
        <div class="left-top"><span></span>栏目选择</div>
        <iframe name="center_frame" id="center_frame" src="" frameborder="false" scrolling="auto" allowtransparency="true"></iframe>
    </div>
</div>

<div class="content" id="main">
    <div class="place">
        <span>位置：</span>
        <ul class="placeul" id="current_pos"></ul>
        <ul class="placeul">
            <li id="current_pos_attr"></li>
        </ul>
    </div>
    <iframe class="content" id="contentFrame" name="right" src="{{$url}}"></iframe>
</div>

<div class="fav-nav">
    <div id="panellist"></div>
    <div id="paneladd"></div>
    <input type="hidden" id="menuid" value="">
    <input type="hidden" id="bigid" value="" />
    <div id="help" class="fav-help"></div>
</div>

<script type="text/javascript">
    function windowW() {
        if ($('#Scroll').height() < $("#leftMain").height()) {
            $(".scroll").show();
        } else {
            $(".scroll").hide();
        }
    }
    windowW();

    function menu(menuId) {
        $("#menuid").val(menuId);
        $("#bigid").val(menuId);
        $("#leftMain").load("{{url('admin/getMenu')}}/" + menuId + '?limit=25', function () {
            windowW();
        });

        //当点击顶部菜单后，隐藏中间的框架
        $('#display_center_id').css('display', 'none');
        $('#main').css({'left':'12%', 'width':'88%'});

        $.get("{{url('admin/getMenuPos')}}/" + menuId, function (data) {
            $('#current_pos_attr').html('');
            $("#current_pos").html(data);
        });
    }

    function _MP(menuId, targetUrl) {
        $("#menuid").val(menuId);

        if (menuId != 822) {
            //当点击顶部菜单后，隐藏中间的框架
            $('#display_center_id').css('display', 'none');
            $('#main').css({'left':'12%', 'width':'88%'});
        }

        if(targetUrl.indexOf('://') == -1) targetUrl = '{{getExtendsUrl()}}' + targetUrl;

        $("#contentFrame").attr('src', targetUrl + '&menuid=' + menuId);
        $.get("{{url('admin/getMenuPos')}}/" + menuId, function (data) {
            $('#current_pos_attr').html('');
            $("#current_pos").html(data);
        });
        $("#current_pos").data('clicknum', 1);
    }
    
    function addtext(message) {}

    $(function () {
        //默认载入左侧菜单
        $("#leftMain").load("{{url('admin/getMenu')}}/10");
        $.get("{{url('admin/getMenuPos/10')}}", function (data) {
            $('#current_pos_attr').html('');
            $("#current_pos").html(data);
        });
    });

</script>
</body>
</html>
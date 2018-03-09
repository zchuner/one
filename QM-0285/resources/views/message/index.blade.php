<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>温馨提示</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css">
        body{font:normal 12px/24px '微软雅黑'}
        a{cursor:pointer}
        .prompt h4{color:#3B4658}
        .prompt .promptmain{max-width:500px;-webkit-box-shadow:0 0 25px #E4E3E3;-moz-box-shadow:0 0 25px #E4E3E3;box-shadow:0 0 25px #E4E3E3;position:relative;margin:13% auto 0 auto}
        .prompt .prompthead{margin:0;padding:17px 15px;background:#3B4658;border-radius:5px 5px 0 0;-webkit-border-radius:5px 5px 0 0}
        .prompt .promptfooter{margin:0;padding:6px 15px;background:#3B4658;border-radius:0 0 5px 5px;-webkit-border-radius:0 0 5px 5px}
        .prompt .promptfooter a{color:#B5B8BE}
        .prompt .prompcontainer{background-color:#FCFCFC;padding:40px 20px}
        .prompt .prompcontainer button{margin:-67px -15px 0 0}
        .prompt a{line-height:28px}
        .prompt i{font-size:18px;padding:0 10px}
    </style>
</head>
<body>
<div class="container">
    <div class="prompt text-center">
        <div class="promptmain">
            <div class="prompthead"></div>
            <div class="prompcontainer">
                <button class="close close-sm" type="button" onclick="window.close();"><i class="fa fa-close"></i></button>
                <h4><i class="fa fa-5x fa-w {{$data['ico']}}"></i><span>{{$data['content']}}</span></h4>
                <a class="alert-link">如果页面没有跳转，请点击操作按钮。</a>
            </div>
            <div class="promptfooter">
                <a onclick="{{$data['url']}}" class="alert-link">[ 如果你的浏览器没有跳转, 请点击此链接 ]</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    setTimeout(function () {
        {!! $data['url'] !!}
    }, {{$data['timeout']}});
</script>

</body>
</html>
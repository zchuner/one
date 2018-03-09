<?php
$pc_hash = '';
$AdminMenu = new \App\Http\Model\AdminMenu()
?>

@foreach($menu as $v)
        <dd>
            <div class="title">
                <span title="{{getLang('expand_or_contract')}}"><img src="{{asset('admin/images/left-ico01.png')}}"/></span>{{getLang($v['name'])}}
            </div>
            <ul class="menu-son">
                @foreach($AdminMenu->admin_menu($v['id']) as $_key => $_m)
                    <li id="_MP{{$_m['id']}}" class="sub_menu">
                        <cite></cite>
                        <a href="javascript:_MP({{$_m['id']}}, '?m={{$_m['m']}}&c={{$_m['c']}}&a={{$_m['a']}}{!! $_m['data'] ? '&' . $_m['data'] : '' !!}');">
                            {{getLang($_m['name'])}}
                        </a>
                        <i></i>
                    </li>
                @endforeach
            </ul>
        </dd>
@endforeach

<script type="text/javascript">
    $(".switchs").each(function (i) {
        var ul = $(this).parent().next();
        $(this).click(function () {
            if (ul.is(':visible')) {
                ul.hide();
                $(this).removeClass('on');
            } else {
                ul.show();
                $(this).addClass('on');
            }
        })
    });
</script>
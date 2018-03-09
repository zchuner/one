var qm = {

    /**
     * 弹出消息提示
     * @param msg 消息内容
     * @param time 显示时间 秒
     * @returns {boolean}
     */
    message: function (msg, time) {
        if (!msg) return false;
        $('.cover-message').each(function () {
            $(this).remove();
        });
        var html = $('<div class="cover-message animated bounceIn">' + msg + '</div>').css({
                'position': 'fixed',
                'padding': '15px',
                'max-width': '200px',
                'top': '50%',
                'left': '50%',
                'z-index': '9999999999',
                'background': 'rgba(6, 141, 218, .9)',
                'color': '#fff',
                'text-align': 'center',
                '-webkit-border-radius': '3px',
                '-moz-border-radius': '3px',
                'border-radius': '3px'
            }),
            timeOut = (time) ? (time * 1000) : 3000;
        setTimeout(function () {
            html.css({
                'margin': '-' + (html[0].clientHeight / 2) + 'px 0px 0px -' + (html[0].clientWidth / 2) + 'px'
            });
        });
        $('body').append(html);
        setTimeout(function () {
            html.removeClass('bounceIn').addClass('bounceOut');
            setTimeout(function () {
                html.remove();
            }, 200);
        }, timeOut);
    }
};

$(document).ready(function () {
    var navBarNavBox = $('.navbar-nav'),
        navBarNavWidth = navBarNavBox.width(),
        maxWidth = 90;

    navBarNavBox.find('.item').each(function () {
        if ($(this).hasClass('dropdown')) return;
        if (($(this).index() + 1) >= (navBarNavWidth / maxWidth)) {
            var html = '<li><a href="' + $(this).find('a').attr('href') + '" title="' + $(this).find('a').text() + '">' + $(this).find('a').text() + '</a></li>';
            $(this).parent().find('.dropdown .dropdown-menu').prepend(html);
            $(this).remove();
        }
    });
});
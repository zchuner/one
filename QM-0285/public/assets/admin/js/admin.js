$(document).ready(function () {

    var top_menu = $('.header .nav'),
        left_menu = $('.left-menu .menu-son');

    $(document)

        .on('click', '.header .nav li', function () {
            /*var index = $(this).index();
            if (index < 4) {
                if (index === 4) {
                    $('.left-menu dd:last .title').click();

                    $(this).parent().find('.active').removeClass('active');
                    $(this).addClass('active');
                } else {
                    if ($('.left-menu dd:first .menu-son').attr('style')) {
                        $('.left-menu dd:first .title').click();
                    }
                    left_menu.find('.active').removeClass('active');
                    left_menu.find('li:eq(' + index + ')').addClass('active');
                    $(this).parent().find('.active').removeClass('active');
                    $(this).addClass('active');
                }
            } else {
                left_menu.find('.active').removeClass('active');
                $(this).parent().find('.active').removeClass('active');
                $(this).addClass('active');
            }*/

            $(this).parent().find('.active').removeClass('active');
            $(this).addClass('active');
        })

        .on('click', '.left-menu dd:first .menu-son li', function () {
            /*top_menu.find('li.active').removeClass('active');
            top_menu.find('li:eq(' + $(this).index() + ')').addClass('active');*/
            $(this).parent().find('.active').removeClass('active');
            $(this).addClass('active');
        })

        .on('click', '.left-menu dd .title', function () {
            var $ul = $(this).next('ul');
            $(this).parents('.left-menu').find('ul').slideUp();
            if ($ul.is(':visible')) $(this).next('ul').slideUp();
            else $(this).next('ul').slideDown();
        })

        .on('click', '.toolbar .click', function () {
            $('.tip-box').fadeIn(200);
        })

        .on('click', '#videoPlayer .tip-top .close', function () {
            $('#videoPlayer').fadeOut(200, function () {
                $('#videoPlayer').remove();
            });
        })

        .on('click', '.tip-box .tip-top .close', function () {
            $('.tip-box').fadeOut(200);
        })

        .on('click', '.tip-box .tip .sure', function () {
            $('.tip-box .tip-top .close').click();
        })

        .on('click', '.tip-box .tip .cancel', function () {
            $('.tip-box .tip-top .close').click();
        })

        .on('click', '.imglist li', function () {
            $('.imglist li.selected').removeClass('selected');
            $(this).addClass('selected');
        })

        .on('click', '.content table tr th :checkbox', function () {
            $('.content table tr td :checkbox').each(function () {
                $(this).attr('checked', !$(this).attr('checked'));
            });
        })

        .on('click', '.content .selectAll', function () {
            $('.content table tr td :checkbox').attr('checked', true);
        })

        .on('click', '.content .unSelect', function () {
            $('.content table tr td :checkbox').attr('checked', false);
        })

        .on('change', '.content .category .parentCategory', function () {
            var model = $(this).find('option:selected').attr('data-model');
            if (model) $(this).parents('.forminfo').find('.model').attr('disabled', true).find('option[value="' + model + '"]').attr('selected', true);
            else $(this).parents('.forminfo').find('.model').attr('disabled', false).find('option[value="1"]').attr('selected', true);
        });
});

/**
 * 删除内容并提示
 */
function dataDelete(url, message) {
    if (url) {
        var tips = confirm((message) ? message : '删除后不可恢复，确定删除吗？');
        if (tips) location.href = url;
    }
}

/**
 * 弹窗播放视频
 * @param file_id 视频ID
 * @param title 视频标题
 * @param app_id APP_ID
 */
function videoPlayer(file_id, title, app_id) {
    if (!file_id) return alert('没有可播放的资源！');

    if (!$('head #h5connect').attr('src')) {
        $('head').append('<script id="h5connect" type="text/javascript" src="/assets/lib/js/h5connect.js"></script>');
    }

    if (!title) title = '视频预览';

    var html = '' +
        '<div class="tip-box" id="videoPlayer" style="display:block">' +
            '<div class="bg"></div>' +
            '<div class="tip" style="height:308px">' +
                '<div class="tip-top">' +
                    '<span>' + title + '</span>' +
                    '<a class="close"></a>' +
                '</div>' +
                '<div class="tip-content">' +
                    '<div id="player"></div>' +
                '</div>' +
            '</div>' +
        '</div>';

    $('body').append(html);

    setTimeout(function () {
        var option = {
            "file_id": file_id,
            "app_id": app_id,
            "auto_play": 1,
            "width": 485,
            "height": 268,
            "https": 0
        };
        new qcVideo.Player("player", option);
    }, 200);
}
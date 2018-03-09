/**
 * Created by Administrator on 2017/5/3.
 */
var WEB_PATH = $('meta[name="app"]').attr('content'),
    Version = qcVideo.get('Version'),
    sha1js_path = WEB_PATH + 'assets/admin/js/video_upload/calculator_worker_sha1.js',
    uploadBox = $('.fileuploader-items');

(function () {
    if (!qcVideo.uploader.supportBrowser()) {
        $('.formbody form').hide();
        $('.formbody').append('<h3>当前浏览器不支持上传，请升级浏览器或者下载最新的chrome浏览器</h3>');
        if (Version.IS_MOBILE) {
            alert('当前浏览器不支持上传，请升级系统版本或者下载最新的chrome浏览器');
        } else {
            alert('当前浏览器不支持上传，请升级浏览器或者下载最新的chrome浏览器');
        }
        return;
    }
    accountDone('select_file', sha1js_path);
})();

/**
 * 开始上传
 * @param upBtnId 上传按钮ID
 * @param sha1js_path 计算sha1.js的位置
 */
function accountDone(upBtnId, sha1js_path) {

    var ErrorCode = qcVideo.get('ErrorCode'),
        Log = qcVideo.get('Log'),
        JSON = qcVideo.get('JSON'),
        util = qcVideo.get('util'),
        Code = qcVideo.get('Code'),
        Version = qcVideo.get('Version');

    qcVideo.uploader.init({
        web_upload_url: 'https://vod2.qcloud.com/v3/index.php',

        /*****************************************************************
         *
         * desc 从服务端获取签名的函数。该函数包含两个参数：
         * argObj: 待上传文件的信息，关键信息包括：
         * f: 视频文件名(可从getSignature的argObj中获取)，
         * ft: 视频文件的类型(可从getSignature的argObj中获取)，
         * fs: 视频文件的sha1值(必须从getSignature的argObj中获取)
         * callback：客户端从自己的服务端得到签名之后，调用该函数将签名传递给SDK
         *
         *****************************************************************/
        getSignature: function (argObj, callback) {
            var sigUrl = WEB_PATH + 'admin/getVideoData?type=getSignature&'
                + 'f=' + encodeURIComponent(argObj.f)
                + '&ft=' + encodeURIComponent(argObj.ft)
                + '&fs=' + encodeURIComponent(argObj.fs);
            $.get(sigUrl).done(function (ret) {
                callback(ret)
            });
        },

        upBtnId: upBtnId,
        after_sha_start_upload: true,//sha计算完成后，开始上传 (默认关闭立即上传)
        sha1js_path: sha1js_path,
        forceH5Worker: true,
        filters: {
            max_file_size: '8gb',
            mime_types: [],
            video_only: true
        }
    }, {
        //2: 回调
        onFileUpdate: function (args) {

            console.log(Code.CODE_NAME[args.code])

            /**
             * 更新文件状态和进度
             * @param args
             * { id:文件ID, size:文件大小, name:文件名称, status:状态, percent:进度 speed:速度, errorCode:错误码, serverFileId:后端文件ID }
             */

            if (args.code == Code.SHA_FAILED) {
                $('.message-box').show().find('#error').text('该浏览器无法计算SHA，请更换或浏览器！');
                return alert('该浏览器无法计算SHA');
            }

            switch (args.status) {
                case 1:
                    // 计算SHA完成后
                    progress(args);
                    $('#serverFileId').val(args.id);
                    $('#title').attr('readonly', true);

                    break;
                case 2:
                    // 上传中
                    progress(args);
                    break;
                case 5:
                    // 上传完成
                    if (parseInt(args.code) !== Code.UPLOAD_DONE) return alert(Code.CODE_NAME[args.code]);
                    $('#file_id').val(args.serverFileId);
                    $('#title').attr('readonly', false);
                    break;
                case 10:
                    // SHA计算中
                    var percent = (args.percent) ? args.percent + '%' : ($.cookie('percent')) ? $.cookie('percent') : '';
                    $('.message-box').show().find('#error').text(Code.CODE_NAME[args.code] + '，计算完成后将会自动上传，当前完成进度：' + percent);
                    break;
                default:
                    break;
            }
        },
        onFileStatus: function (info) {
            /**
             * 文件状态发生变化
             * @param info
             * {done:完成数量 , fail:失败数量 , sha:计算SHA或者等待计算SHA中的数量 , wait:等待上传数量 , uploading:上传中的数量}
             */
            //console.log('各状态总数:');
            //console.log(info);
        },
        onFilterError: function (args) {
            /**
             * 上传时错误文件过滤提示
             * @param args
             * {code:{-1:文件类型异常, -2:文件名异常}, message:错误原因, solution:解决方法}
             */
            var msg = args.message + (args.solution ? (';solution==' + args.solution) : '');
            $('#error').html(msg).parents('.message-box').show();
            setTimeout(function () {
                $('#error').html('').parents('.message-box').slideUp();
            }, 1500);
        }
    });

    $('.column-actions a').on('click', function () {
        var type = $(this).attr('data-type');
        switch (type) {
            case 'start':
                //@api 开始上传
                $(this).hide().parent().find('.fileuploader-action-suspend').show();
                qcVideo.uploader.startUpload();
                break;
            case 'suspend':
                //@api 暂停上传
                var percent = uploadBox.find('.progress-bar2 span').text();
                $.cookie('percent', percent);
                $(this).hide().parent().find('.fileuploader-action-start').show();
                qcVideo.uploader.stopUpload();
                uploadBox.find('.progress-bar2 span').text('已暂停');
                break;
            case 'retry':
                //@api 恢复上传（错误文件重新）
                qcVideo.uploader.reUpload();
                break;
            case 'remove':
                //@api 删除文件
                uploadBox.hide();
                $('#select_file').slideDown();
                $.cookie('percent', '0%');
                var file_id = $('#serverFileId').val();
                qcVideo.uploader.deleteFile(file_id);
                break;
        }
    });
}

/**
 * 实时更新上传进度
 * @param args
 */
function progress(args) {
    var percent = (args.percent) ? args.percent + '%' : ($.cookie('percent')) ? $.cookie('percent') : '',
        filename = args.name;

    var fileType = filename.split(".");

    $('#title').val(fileType[0]);

    $('#select_file').slideUp();
    $('.message-box').slideUp().find('#error').text('');
    uploadBox.show();
    uploadBox.find('.columns .fileuploader-item-icon i').text(args.type);
    uploadBox.find('.columns .column-title .filename').text(filename);
    uploadBox.find('.columns .column-title .size').text(getFileSize(args.size));
    uploadBox.find('.columns .column-title .speed').text(args.speed);
    uploadBox.find('.columns .item-ext i').text(fileType[1]);
    uploadBox.find('.progress-bar2 span').text(percent);
    uploadBox.find('.progress-bar2 .fileuploader-progressbar .bar').width(percent);
}

/**
 * 转换文件大小
 * @param fileByte
 * @returns {string}
 */
function getFileSize(fileByte) {
    var fileSizeByte = fileByte;
    var fileSizeMsg = "";
    if (fileSizeByte < 1048576) fileSizeMsg = Math.ceil((fileSizeByte / 1024)) + "KB";
    else if (fileSizeByte == 1048576) fileSizeMsg = "1MB";
    else if (fileSizeByte > 1048576 && fileSizeByte < 1073741824) fileSizeMsg = Math.ceil((fileSizeByte / (1024 * 1024))) + "MB";
    else if (fileSizeByte > 1048576 && fileSizeByte == 1073741824) fileSizeMsg = "1GB";
    else if (fileSizeByte > 1073741824 && fileSizeByte < 1099511627776) fileSizeMsg = Math.ceil((fileSizeByte / (1024 * 1024 * 1024))) + "GB";
    else fileSizeMsg = "文件超过1TB";
    return fileSizeMsg;
}
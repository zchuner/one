<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/2
 * Time: 22:14
 * Desc: 后台主体
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Model\Admin;
use App\Http\Model\AdminMenu;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private $AdminMenu;

    public function __construct()
    {
        $this->AdminMenu = new AdminMenu();
    }

    /**
     * 后台框架主体
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $url = $request->input('url');
        $url = ($url) ? trim($url) : url('admin/home');

        $menu = $this->AdminMenu->admin_menu(0);
        return view('admin.home.index', compact('url'))->with('menu', $menu);
    }

    /**
     * 后台主页 HOME
     * @return mixed
     */
    public function home()
    {
        $admin = session('admin');
        $data = Admin::find($admin['userid']);
        return view('admin.home.home', compact('data'));
    }

    /**
     * 获取后台右侧菜单
     * @param Request $request
     * @param $menuId
     * @return $this
     */
    public function getMenu(Request $request, $menuId)
    {
        $limit = $request->input('limit');
        $menuId = intval($menuId);
        $menu = $this->AdminMenu->admin_menu($menuId);
        return view('admin.home.menu', compact('menu'))->with('menuId', $menuId);
    }

    /**
     * 获取后台位置
     * @param $id
     * @return string
     */
    public function getMenuPos($id)
    {
        $pos = $this->AdminMenu->currentPos($id);
        return $pos;
    }

    /**
     * 获取关键词
     * @param Request $request
     * @return array|string
     */
    public function getKeywords(Request $request)
    {
        $title = $request->input('title');
        return $title;
    }

    /**
     * 腾讯 VOD 远程操作
     * @param Request $request
     * @return array|bool|string
     */
    public function getVideoData(Request $request)
    {
        if ($request->input('type') == 'getSignature') {

            $vodConfig = getVodConfig();

            // Step 1：获取签名所需信息获取得到的签名所需信息，如下
            $secret_id = $vodConfig['SecretId'];
            $secret_key = $vodConfig['SecretKey'];

            // Step 2：设置签名有效时间
            $current = time();
            $expired = $current + 86400;  // 签名有效期：1天

            // Step 3：根据客户端所提交的文件信息，拼装参数列表
            $arg_list = [
                "s" => $secret_id, //云api管理页中的Secret ID
                "t" => $current, //
                "e" => $expired, //签名失效时刻，是一个符合 Unix Epoch时间戳规范的 数值，单位为秒。e 的计算方式为 e = t + 签名有效时长。签名有效时长最大取值为7776000（90天）
                "f" => $request->input('f'), //视频文件本地名称，长度在40个字节以内，不得包含 /: * ? " < > 等字符
                "ft" => $request->input('ft'), //文件类型，例如mp4,flv,avi等，注意不需要"."
                "fs" => $request->input('fs'), //文件的SHA-1签名，由客户端计算并提交到APP后台
                "uid" => md5('rouyi/qimaweb'), //用户在APP内的唯一标识，建议取md5计算结果，例如对qq，号码12345就是uid=md5(12345)
                "r" => rand(), //随机串，无符号10进制整数，用户需自行生成，最长10位
                "tc" => 1, //是否转码，需要转码时，tc=1
                "ss" => 1, //转码时是否截图，需要截图时，ss=1。本参数仅tc=1时有效
                "wm" => 0, //转码时是否加水印，需要转码加水印时，wm=1。本参数仅tc=1时有效
                "cid" => 0, //文件分类id，需要指定分类id时填入
                "tag.1" => "" //文件标签，可指定最多10个标签，使用方式：例如三个标签就是tag.1=a&tag.2=b&tag.3=c
            ];

            // Step 4：生成签名
            $orignal = http_build_query($arg_list);
            $signature = base64_encode(hash_hmac('SHA1', $orignal, $secret_key, true) . $orignal);
            return $signature;

        } else if ($request->input('type') == 'getVod' || $request->input('type') == 'getDelete') {

            $fileId = $request->input('fileId');
            if (!$fileId) exit(json_encode(['code' => -100, 'message' => '没有接收到 fileId']));
            $action = ($request->input('type') == 'getDelete') ? 'DeleteVodFile' : 'GetVideoInfo';
            $vod = getVodFile($fileId, $action, 0);
            return $vod;

        }

        return '';
    }
}
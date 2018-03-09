<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/6
 * Time: 14:37
 * Desc: 验证码
 */

namespace app\Http\Controllers\Code;

use App\Http\Controllers\Controller;
use App\Services\VerifyCode;
use Gregwar\Captcha\CaptchaBuilder;

class CodeController extends Controller
{
    /**
     * 随机展示数字和字符串验证码
     * @param int $width
     * @param int $height
     * @param $tmp
     * @return mixed
     */
    public function index($width = 100, $height = 40, $tmp)
    {
        unset($tmp);
        $codeRand = rand(10, 99);
        if ($codeRand % 2 == 0) {
            return VerifyCode::get($width, $height); //简单的加减法验证码
        }
        return $this->StringCode($width, $height);
    }

    /**
     * 获取验证码 普通
     * @param int $width 宽度
     * @param int $height 高度
     */
    private function StringCode($width = 100, $height = 40)
    {
        $builder = new CaptchaBuilder;
        $builder->build($width, $height);
        $phrase = $builder->getPhrase();
        session(['code' => $phrase]);
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
}
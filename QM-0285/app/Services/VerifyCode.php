<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/26
 * Time: 18:10
 * Desc: 改造的加减法验证类
 * 使用示例 VerifyCode::get('xxx', 20);
 * 验证示例 VerifyCode::check('1', 'xxx');
 */

namespace App\Services;

class VerifyCode
{
    /**
     * php验证码  算式验证码
     * @param $width
     * @param $height
     */
    public static function get($width = 140, $height = 44)
    {
        header("Content-type: image/png");
        ob_end_clean();

        //创建真彩色白纸
        $im = @imagecreatetruecolor($width, $height) or die("建立图像失败");

        //获取背景颜色
        $background_color = imagecolorallocate($im, 255, 255, 255);

        //填充背景颜色
        imagefill($im, 0, 0, $background_color);

        //获取边框颜色
        $border_color = imagecolorallocate($im, 200, 200, 200);

        //画矩形，边框颜色200,200,200
        imagerectangle($im, 0, 0, $width - 1, $height - 1, $border_color);


        //逐行炫耀背景，全屏用1或0
        for ($i = 2; $i < $height - 2; $i++) {
            //获取随机淡色
            $line_color = imagecolorallocate($im, rand(200, 255), rand(200, 255), rand(200, 255));
            //画线
            //imageline($im, 2, $i, $width - 1, $i, $line_color);   //画一条线  画线条
            imageellipse($im, rand(0, 120), rand(0, 120), rand(0, 120), rand(0, 120), $line_color);   //画椭圆
        }


        //设置印上去的文字
        $firstNum = rand(1, 9);
        $secondNum = rand(1, 9);
        $actionStr = $firstNum > $secondNum ? '-' : '+';

        //获取第1个随机文字
        $imStr[0]["s"] = $firstNum;
        $imStr[0]["x"] = rand(2, 5);
        $imStr[0]["y"] = rand(1, 4);

        //获取第2个随机文字
        $imStr[1]["s"] = $actionStr;
        $imStr[1]["x"] = $imStr[0]["x"] + rand(0, 1);
        $imStr[1]["y"] = rand(1, 5);

        //获取第3个随机文字
        $imStr[2]["s"] = $secondNum;
        $imStr[2]["x"] = $imStr[1]["x"] + rand(0, 1);
        $imStr[2]["y"] = rand(1, 5);

        //获取第3个随机文字
        $imStr[3]["s"] = '=';
        $imStr[3]["x"] = $imStr[2]["x"] + rand(0, 1);
        $imStr[3]["y"] = 3;

        //获取第3个随机文字
        $imStr[4]["s"] = '?';
        $imStr[4]["x"] = $imStr[3]["x"] + rand(0, 1);
        $imStr[4]["y"] = 3;

        //文字
        $text = '';

        //获取随机较深颜色
        $text_color = imagecolorallocate($im, rand(50, 180), rand(50, 180), rand(50, 180));

        //写入随机字串
        for ($i = 0; $i < 5; $i++) {
            $text .= $imStr[$i]["s"];
        }


        /**
         * 为图片添加噪点，线条，雪花，增加干扰度
         */
        for ($i = 0; $i < 6; $i++) {
            $color = imagecolorallocate($im, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imageline($im, mt_rand(0, 140), mt_rand(0, 28), mt_rand(0, 140), mt_rand(0, 28), $color);
        }

        for ($i = 0; $i < 100; $i++) {
            $color = imagecolorallocate($im, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
            imagestring($im, mt_rand(1, 5), mt_rand(0, 140), mt_rand(0, 28), '*', $color);
        }

        imagestring($im, 5, rand(($width / 2 + 10), 15), rand(($height / 2), ($height / 2 - 10)), $text, $text_color);

        $code = ($firstNum > $secondNum) ? ($firstNum - $secondNum) : ($firstNum + $secondNum);
        session(['code' => $code]);

        //显示图片
        imagepng($im);

        //销毁图片
        imagedestroy($im);

        return true;
    }

    public static function check($code)
    {
        if (session('code') == trim($code)) {
            return true;
        } else {
            return false;
        }
    }
}
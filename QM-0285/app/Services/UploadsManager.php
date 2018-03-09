<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/6
 * Time: 14:11
 * Desc: 文件上传服务
 */

namespace App\Services;

use App\Http\Model\Attachment;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class UploadsManager
{
    /**
     * 文件上传
     * @param $file
     * @return array
     */
    public function upload($file)
    {
        $config = Config::get('upload');

        // 获取文件相关信息
        $data = [
            'path' => date('Y/m/'), // 保存路径
            'name' => $file->getClientOriginalName(), // 文件原名
            'size' => $file->getClientSize(), // 文件大小
            'ext' => $file->getClientOriginalExtension(), // 文件扩展名
            'image' => (in_array($config['ext'], ['jpg', 'jpeg', 'png', 'gif'])) ? 1 : 0, // 是否为图片
        ];

        if (!in_array($data['ext'], $config['ext'])) return ['code' => -1, 'message' => '不允许上传 ' . $data['ext'] . ' 类型的文件'];
        if ($data['size'] >= $config['size']) return ['code' => -2, 'message' => '文件大小不能超过 ' . $config['size'] . 'KB'];

        // 上传文件
        $filename = date('Y/m/') . time() . rand(100, 999) . '.' . $data['ext'];
        $data['path'] = 'attachment/' . $data['path'] . $filename;

        // 使用我们新建的uploads本地存储空间（目录）
        $bool = Storage::disk('uploads')->put($filename, file_get_contents($file->getRealPath()));
        $field_id = 0;
        if ($bool == true) {
            //如果上传成功，把附件信息写入数据库
            //$field_id = Attachment::insertGetId($data);
        }

        return ['code' => 0, 'filename' => 'attachment/' . $filename, 'field_id' => $field_id];
    }

    /**
     * 取得文件实际大小
     * @param int $size 传入字节
     * @param int $digits 返回几位小数
     * @return string
     */
    private function getSize($size, $digits = 2)
    {
        $unit = array('', 'K', 'M', 'G', 'T', 'P');
        $base = 1024;
        $i = floor(log($size, $base));
        $n = count($unit);
        if ($i >= $n) {
            $i = $n - 1;
        }
        return round($size / pow($base, $i), $digits) . ' ' . $unit[$i] . 'B';
    }
}

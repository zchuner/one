<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Hits extends Model
{
    protected $table = 'hits';
    protected $primaryKey = 'hitsid';
    public $timestamps = false;
    protected $guarded = [];

    /**
     * 点击统计
     * @param $modelId
     * @param $id
     * @return bool|mixed
     */
    public function getItem($modelId, $id)
    {
        if ($modelId && $id) {
            $hitsId = 'c-' . $modelId . '-' . $id;
            $r = $this->getCount($hitsId);
            if (!$r) return false;
            return $this->hits($hitsId);
        }
        return false;
    }

    /**
     * 获取专题页点击统计
     * @param $id
     * @param $module
     * @return bool|mixed
     */
    public function getSpecialItem($id, $module)
    {
        if ((preg_match('/([^a-z0-9_\-]+)/i', $module))) return false;
        $hitsid = $module . '-' . $id;
        $r = $this->getCount($hitsid);
        if (!$r) return false;
        extract($r);
        return $this->hits($hitsid);
    }

    /**
     * 获取点击数量
     * @param $hitsId
     * @return array|bool
     */
    public function getCount($hitsId)
    {
        $r = $this->find($hitsId);
        if (!$r) return false;
        return $r;
    }

    /**
     * 点击次数统计
     * @param $hitsId
     * @return mixed
     */
    private function hits($hitsId)
    {
        $r = $this->find($hitsId);
        if (!$r) return false;
        $views = $r['views'] + 1;
        $yesterdayviews = (date('Ymd', $r['updatetime']) == date('Ymd', strtotime('-1 day'))) ? $r['dayviews'] : $r['yesterdayviews'];
        $dayviews = (date('Ymd', $r['updatetime']) == date('Ymd', time())) ? ($r['dayviews'] + 1) : 1;
        $weekviews = (date('YW', $r['updatetime']) == date('YW', time())) ? ($r['weekviews'] + 1) : 1;
        $monthviews = (date('Ym', $r['updatetime']) == date('Ym', time())) ? ($r['monthviews'] + 1) : 1;
        $sql = [
            'views' => $views,
            'yesterdayviews' => $yesterdayviews,
            'dayviews' => $dayviews,
            'weekviews' => $weekviews,
            'monthviews' => $monthviews,
            'updatetime' => time()
        ];

        $this->where('hitsid', $hitsId)->update($sql);

        return $views;
    }
}
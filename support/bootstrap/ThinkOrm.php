<?php
/**
 * User: ZhuJun
 * Date: 2021/12/14
 * Time: 下午 07:00
 * Email: mr.zhujun1314@gmail.com
 */

namespace support\bootstrap;


use think\facade\Db;
use Webman\Bootstrap;
use Workerman\Timer;

class ThinkOrm implements Bootstrap
{
    // 进程启动时调用
    public static function start($worker)
    {
        // 配置
        Db::setConfig(config('mysql'));
        // 维持mysql心跳
        if ($worker) {
            Timer::add(55, function () {
                $connections = config('mysql.connections', []);
                foreach ($connections as $key => $item) {
                    if ($item['type'] == 'mysql') {
                        Db::connect($key)->query('select 1');
                    }
                }
            });
        }
    }
}
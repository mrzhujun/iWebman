<?php
/**
 * User: ZhuJun
 * Date: 2021/12/17
 * Time: 下午 04:26
 * Email: mr.zhujun1314@gmail.com
 */

namespace process;


use think\facade\Db;
use Workerman\Timer;

class TaskTest
{
    public function  onWorkerStart()
    {

        $model =  new \app\model\mongo\Test();
        $time = time();
        while (true) {
            $model->updateOne(['a' => 1], ['$inc' => ['b'=>1]]);
            if (time() - $time > 10) {
                break;

            }
        }
        echo 'over';
    }
}
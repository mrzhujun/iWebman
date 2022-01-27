<?php
/**
 * User: ZhuJun
 * Date: 2021/12/17
 * Time: 下午 04:16
 * Email: mr.zhujun1314@gmail.com
 */

namespace app\model\mongo;


use IMongo\ConfigStruct;
use IMongo\MongoModel;

class Base extends MongoModel
{
    public function __construct()
    {
        $config = new ConfigStruct(config('mongodb.host'),config('mongodb.port'),config('mongodb.user'),config('mongodb.password'));
        parent::__construct($config);
    }
}
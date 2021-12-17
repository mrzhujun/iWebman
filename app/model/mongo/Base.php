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
        $config = new ConfigStruct('192.168.4.206','27017');
        parent::__construct($config);
    }
}
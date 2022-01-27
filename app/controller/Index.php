<?php
namespace app\controller;

use app\common\TestPerson;
use app\model\Test;
use support\Request;
use think\facade\Db;

class Index
{
    public function arrayMap(string $str): \Closure
    {
        return function ($do_arr)use ($str) {
            return $do_arr.$str;
        };
    }

    public function index(Request $request)
    {
        $model = new \app\model\mongo\Test();
        $rs = $model->insertOne(['aa'=>111]);

//        Db::table('test')->insert(['aa'=>'aa']);
//        $p = new TestPerson();
//        $p->setAddress('中国');
//        $c = $this->arrayMap('a');
        return response($rs->getInsertedId());
    }

    public function view(Request $request)
    {
        return view('index/view', ['name' => 'webman']);
    }

    public function json(Request $request)
    {
        return json(['code' => 0, 'msg' => 'ok']);
    }

}

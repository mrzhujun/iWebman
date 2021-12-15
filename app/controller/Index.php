<?php
namespace app\controller;

use support\Request;
use think\facade\Db;

class Index
{
    public function index(Request $request)
    {
        $rs = Db::table('uni')->insert(['uni'=>'aaa']);
        return response('hello webman'.$rs);
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

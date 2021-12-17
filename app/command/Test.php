<?php
/**
 * User: ZhuJun
 * Date: 2021/12/17
 * Time: 下午 02:24
 * Email: mr.zhujun1314@gmail.com
 */

namespace app\command;


use app\common\TestArray;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Test extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'test';
    protected static $defaultDescription = '测试redis ';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $model =  new \app\model\mongo\Test();
        $model->insertOne(['a'=>1,'b'=>0]);
        return self::SUCCESS;
    }
}
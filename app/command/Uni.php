<?php
/**
 * User: ZhuJun
 * Date: 2021/12/15
 * Time: 上午 11:58
 * Email: mr.zhujun1314@gmail.com
 */

namespace app\command;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Uni extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'uni';
    protected static $defaultDescription = '显示当前MySQL服务器配置';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('信息如下：');
        $table = new Table($output);
        $table->setHeaders(['title']);
        for ($i=1;$i<=20;$i++) {
            $output->writeln($i);
            sleep(1);
        }
        return self::SUCCESS;
    }
}
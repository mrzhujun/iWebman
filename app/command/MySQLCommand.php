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

class MySQLCommand extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'config:mysql';
    protected static $defaultDescription = '显示当前MySQL服务器配置';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('MySQL配置信息如下：');
        $config = config('mysql');
        $headers = ['name', 'default', 'driver', 'host', 'port', 'database', 'username', 'password', 'unix_socket', 'charset', 'collation', 'prefix', 'strict', 'engine', 'schema', 'sslmode'];
        $rows = [];
        foreach ($config['connections'] as $name => $db_config) {
            $row = [];
            foreach ($headers as $key) {
                switch ($key) {
                    case 'name':
                        $row[] = $name;
                        break;
                    case 'default':
                        $row[] = $config['default'] == $name ? 'true' : 'false';
                        break;
                    default:
                        $row[] = $db_config[$key] ?? '';
                }
            }
            if ($config['default'] == $name) {
                array_unshift($rows, $row);
            } else {
                $rows[] = $row;
            }
        }
        $table = new Table($output);
        $table->setHeaders($headers);
        $table->setRows($rows);
        $table->render();
        return self::SUCCESS;
    }
}
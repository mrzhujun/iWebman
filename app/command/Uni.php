<?php
/**
 * User: ZhuJun
 * Date: 2021/12/15
 * Time: 上午 11:58
 * Email: mr.zhujun1314@gmail.com
 */

namespace app\command;

use support\Log;
use support\Redis;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use think\facade\Db;

class Uni extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'uni';
    protected static $defaultDescription = '测试redis ';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('信息如下：');
        $file = fopen(public_path().'/uni.txt', "r");
        //输出文本中所有的行，直到文件结束为止。
        $total = 0;
        $err = 0;
        $success_err = 0;
        $fail_err = 0;
        while(! feof($file)) {
            $txt = fgets($file);//fgets()函数从文件指针中读取一行
            $x = json_decode(substr($txt,strpos($txt,'{')),true);
            $oaid = $x['uniqueIdentifier'];
            $androidId = $x['androidId'];
            if (!$oaid || $oaid == '00000000-0000-0000-0000-000000000000') {
                $oaid = $androidId;
                if (!$oaid) {
                    continue;
                }
            }
            $log = [
                'redis' => 0,
                'mysql' => 0,
                'oaid'  => $oaid
            ];
            try {
                if (Db::table('uni')->insert(['uni'=>$oaid])) {
                    $log['mysql'] = 1;
                }

            }catch (\Exception $e) {

            }

            if (Redis::pfAdd('uni',[$oaid])) {
                $log['redis'] = 1;
            }
            $total += 1;
            if ($log['mysql'] != $log['redis']) {
                $err += 1;
                if ($log['mysql'] == 1) {
                    $success_err ++;
                }else{
                    $fail_err ++;
                }
            }

            $output->writeln("总数量{$total},错误:{$err},该设置成功:{$success_err},该设置失败:{$fail_err}");
//            Log::debug('哈哈哈',$log);
        }
        fclose($file);
        return self::SUCCESS;
    }
}
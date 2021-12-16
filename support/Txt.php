<?php
/**
 * User: ZhuJun
 * Date: 2021/12/15
 * Time: 下午 05:21
 * Email: mr.zhujun1314@gmail.com
 */

namespace support;


class Txt
{
    public static  function txtRead(string $path) {
        $file = fopen($path, "r");
        $user=array();
        $i=0;
        //输出文本中所有的行，直到文件结束为止。
        while(! feof($file)) {
            $user[$i]= fgets($file);//fgets()函数从文件指针中读取一行
            $i++;
        }
        fclose($file);
        $user=array_filter($user);
        return $user;
    }
}
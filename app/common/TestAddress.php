<?php
/**
 * User: ZhuJun
 * Date: 2022/1/26
 * Time: 下午 04:11
 * Email: mr.zhujun1314@gmail.com
 */

namespace app\common;

trait TestAddress {
    private $lat;
    private $lon;

    public function setAddress(string $address) {
        $this->lat = $address.'_lat';
        $this->lon = $address.'_lon';
    }

    public function getLatLon(): string
    {
        return $this->lat.'|'.$this->lon;
    }
}
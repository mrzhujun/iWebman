<?php
/**
 * User: ZhuJun
 * Date: 2021/12/17
 * Time: 下午 06:52
 * Email: mr.zhujun1314@gmail.com
 */

class TestConfig extends \PHPUnit\Framework\TestCase
{
    public function testOne()
    {
        $stack = [];
        $this->assertSame(0,count($stack));

        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertSame(1, count($stack));


        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));
    }
    public function test2()
    {
        $stack = [];
        $this->assertSame(1,count($stack));

        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertSame(1, count($stack));

        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));
    }
}
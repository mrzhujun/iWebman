<?php
/**
 * User: ZhuJun
 * Date: 2021/12/17
 * Time: 下午 02:17
 * Email: mr.zhujun1314@gmail.com
 */


namespace app\common;

use ArrayAccess;
use Countable;
use IteratorAggregate ;
use JsonSerializable;
use ArrayIterator;

class TestArray implements ArrayAccess,Countable,IteratorAggregate,JsonSerializable
{
    protected $items = [];

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
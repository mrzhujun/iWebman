<?php

//try{
//    undf();
//}catch (Error $e) {
//    var_dump($e->getMessage());
//}

class test {
    private $num = 1;
}

$f = function () {
    return $this->num + 1 ;
};

//$test = $f->bindTo(new test,'test');
//echo $test();
var_dump($f->call(new test()));

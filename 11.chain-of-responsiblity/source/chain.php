<?php

abstract class Handler
{
    protected $successor;
    public function setSuccessor($successor)
    {
        $this->successor = $successor;
    }
    abstract public function HandleRequst($request);
}

class ConcreteHandler1 extends Handler
{
    public function HandleRequst($request)
    {
        if (is_numeric($request)) {
            return '请求参数是数字：' . $request;
        } else {
            return $this->successor->HandleRequst($request);
        }
    }
}

class ConcreteHandler2 extends Handler
{
    public function HandleRequst($request)
    {
        if (is_string($request)) {
            return '请求参数是字符串：' . $request;
        } else {
            return $this->successor->HandleRequst($request);
        }
    }
}

class ConcreteHandler3 extends Handler
{
    public function HandleRequst($request)
    {
        return '我也不知道请求参数是啥了，你猜猜？' . gettype($request);
    }
}

$handle1 = new ConcreteHandler1();
$handle2 = new ConcreteHandler2();
$handle3 = new ConcreteHandler3();

$handle1->setSuccessor($handle2);
$handle2->setSuccessor($handle3);

$requests = [22, 'aaa', 55, 'cc', [1, 2, 3], null, new stdClass];

foreach ($requests as $request) {
    echo $handle1->HandleRequst($request) . PHP_EOL;
}

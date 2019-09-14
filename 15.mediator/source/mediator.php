<?php

abstract class Mediator
{
    abstract public function Send(String $message, Colleague $colleague);
}

class ConcreteMediator extends Mediator
{
    public $colleague1;
    public $colleague2;

    public function Send(String $message, Colleague $colleague)
    {
        if ($colleague == $this->colleague1) {
            $this->colleague2->Notify($message);
        } else {
            $this->colleague1->Notify($message);
        }
    }
}

abstract class Colleague
{
    protected $mediator;
    public function __construct(Mediator $mediator)
    {
        $this->mediator = $mediator;
    }

}

class ConcreteColleague1 extends Colleague
{
    public function Send(String $message)
    {
        $this->mediator->Send($message, $this);
    }
    public function Notify(String $message)
    {
        echo "同事1得到信息：" . $message, PHP_EOL;
    }
}

class ConcreteColleague2 extends Colleague
{
    public function Send(String $message)
    {
        $this->mediator->Send($message, $this);
    }
    public function Notify(String $message)
    {
        echo "同事2得到信息：" . $message;
    }
}

$m = new ConcreteMediator();

$c1 = new ConcreteColleague1($m);
$c2 = new ConcreteColleague2($m);

$m->colleague1 = $c1;
$m->colleague2 = $c2;

$c1->Send("吃过饭了吗？");
$c2->Send("没有呢，你打算请客？");

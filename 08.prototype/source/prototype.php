<?php

abstract class Prototype
{
    public $v = 'clone' . PHP_EOL;

    public function __construct()
    {
        echo 'create' . PHP_EOL;
    }

    abstract public function __clone();
}

class ConcretePrototype1 extends Prototype
{
    public function __clone()
    {
    }
}

class ConcretePrototype2 extends Prototype
{
    public function __clone()
    {
    }
}

class Client
{
    public function operation()
    {
        $p1 = new ConcretePrototype1();
        $p2 = clone $p1;

        echo $p1->v;
        echo $p2->v;

        // $p2->v = 123;
        // echo $p1->v;
        // echo $p2->v;

        echo $p1 == $p2 ? "true" : 'false', PHP_EOL;
        echo $p1 === $p2 ? "true" : 'false', PHP_EOL;
    }
}

$c = new Client();
$c->operation();

<?php

interface Flyweight
{
    public function operation($extrinsicState) : void;
}

class ConcreteFlyweight implements Flyweight
{
    private $intrinsicState = 101;
    function operation($extrinsicState) : void
    {
        echo '共享享元对象' . ($extrinsicState + $this->intrinsicState) . PHP_EOL;
    }
}

class UnsharedConcreteFlyweight implements Flyweight
{
    private $allState = 1000;
    public function operation($extrinsicState) : void
    {
        echo '非共享享元对象：' . ($extrinsicState + $this->allState) . PHP_EOL;
    }
}

class FlyweightFactory
{
    private $flyweights = [];

    public function getFlyweight($key) : Flyweight
    {
        if (!array_key_exists($key, $this->flyweights)) {
            $this->flyweights[$key] = new ConcreteFlyweight();
        }
        return $this->flyweights[$key];
    }
}

$factory = new FlyweightFactory();

$extrinsicState = 100;
$flA = $factory->getFlyweight('a');
$flA->operation(--$extrinsicState);

$flB = $factory->getFlyweight('b');
$flB->operation(--$extrinsicState);

$flC = $factory->getFlyweight('c');
$flC->operation(--$extrinsicState);

$flD = new UnsharedConcreteFlyweight();
$flD->operation(--$extrinsicState);

<?php

interface Implementor
{
    public function OperationImp();
}

class ConcreteImplementorA implements Implementor
{
    public function OperationImp()
    {
        echo '具体实现A', PHP_EOL;
    }
}

class ConcreteImplementorB implements Implementor
{
    public function OperationImp()
    {
        echo '具体实现B', PHP_EOL;
    }
}

abstract class Abstraction
{
    protected $imp;
    public function SetImplementor(Implementor $imp)
    {
        $this->imp = $imp;
    }
    abstract public function Operation();
}

class RefinedAbstraction extends Abstraction
{
    public function Operation()
    {
        $this->imp->OperationImp();
    }
}

$impA = new ConcreteImplementorA();
$impB = new ConcreteImplementorB();

$ra = new RefinedAbstraction();

$ra->SetImplementor($impA);
$ra->Operation();

$ra->SetImplementor($impB);
$ra->Operation();

<?php

abstract class AbstractClass
{
    public function TemplateMethod()
    {
        $this->PrimitiveOperation1();
        $this->PrimitiveOperation2();
    }

    abstract public function PrimitiveOperation1();
    abstract public function PrimitiveOperation2();
}

class ConcreteClassA extends AbstractClass
{
    public function PrimitiveOperation1()
    {
        echo '具体类A实现方法1', PHP_EOL;
    }
    public function PrimitiveOperation2()
    {
        echo '具体类A实现方法2', PHP_EOL;
    }
}

class ConcreteClassB extends AbstractClass
{
    public function PrimitiveOperation1()
    {
        echo '具体类B实现方法1', PHP_EOL;
    }
    public function PrimitiveOperation2()
    {
        echo '具体类B实现方法2', PHP_EOL;
    }
}

$c = new ConcreteClassA();
$c->TemplateMethod();

$c = new ConcreteClassB();
$c->TemplateMethod();

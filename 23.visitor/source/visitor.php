<?php

interface Visitor
{
    function VisitConcreteElementA(ConcreteElementA $a);
    function VisitConcreteElementB(ConcreteElementB $b);
}

class ConcreteVisitor1 implements Visitor
{
    public function VisitConcreteElementA(ConcreteElementA $a)
    {
        echo get_class($a) . "被" . get_class($this) . "访问", PHP_EOL;
    }
    public function VisitConcreteElementB(ConcreteElementB $b)
    {
        echo get_class($b) . "被" . get_class($this) . "访问", PHP_EOL;
    }
}

class ConcreteVisitor2 implements Visitor
{
    public function VisitConcreteElementA(ConcreteElementA $a)
    {
        echo get_class($a) . "被" . get_class($this) . "访问", PHP_EOL;
    }
    public function VisitConcreteElementB(ConcreteElementB $b)
    {
        echo get_class($b) . "被" . get_class($this) . "访问", PHP_EOL;
    }
}

interface Element
{
    public function Accept(Visitor $v);
}

class ConcreteElementA implements Element
{
    public function Accept(Visitor $v)
    {
        $v->VisitConcreteElementA($this);
    }
    public function OperationA()
    {

    }
}

class ConcreteElementB implements Element
{
    public function Accept(Visitor $v)
    {
        $v->VisitConcreteElementB($this);
    }
    public function OperationB()
    {

    }
}

class ObjectStructure
{
    private $elements = [];

    public function Attach(Element $element)
    {
        $this->elements[] = $element;
    }

    public function Detach(Element $element)
    {
        $position = 0;
        foreach ($this->elements as $e) {
            if ($e == $element) {
                unset($this->elements[$position]);
                break;
            }
            $position++;
        }
    }

    public function Accept(Visitor $visitor)
    {
        foreach ($this->elements as $e) {
            $e->Accept($visitor);
        }
    }

}

$o = new ObjectStructure();
$o->Attach(new ConcreteElementA());
$o->Attach(new ConcreteElementB());

$v1 = new ConcreteVisitor1();
$v2 = new ConcreteVisitor2();

$o->Accept($v1);
$o->Accept($v2);

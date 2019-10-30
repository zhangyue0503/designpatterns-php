<?php

class Originator
{
    private $state;
    public function SetMeneto(Memento $m)
    {
        $this->state = $m->GetState();
    }
    public function CreateMemento()
    {
        $m = new Memento();
        $m->SetState($this->state);
        return $m;
    }

    public function SetState($state)
    {
        $this->state = $state;
    }

    public function ShowState()
    {
        echo $this->state, PHP_EOL;
    }
}

class Memento
{
    private $state;
    public function SetState($state)
    {
        $this->state = $state;
    }
    public function GetState()
    {
        return $this->state;
    }
}

class Caretaker
{
    private $memento;
    public function SetMemento($memento)
    {
        $this->memento = $memento;
    }
    public function GetMemento()
    {
        return $this->memento;
    }
}

$o = new Originator();
$o->SetState('状态1');
$o->ShowState();

// 保存状态
$c = new Caretaker();
$c->SetMemento($o->CreateMemento());

$o->SetState('状态2');
$o->ShowState();

// 还原状态
$o->SetMeneto($c->GetMemento());
$o->ShowState();

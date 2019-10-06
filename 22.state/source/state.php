<?php

class Context
{
    private $state;
    public function SetState(State $state): void
    {
        $this->state = $state;
    }
    public function Request(): void
    {
        $this->state = $this->state->Handle();
    }
}

interface State
{
    public function Handle(): State;
}

class ConcreteStateA implements State
{
    public function Handle(): State
    {
        echo '当前是A状态', PHP_EOL;
        return new ConcreteStateB();
    }
}

class ConcreteStateB implements State
{
    public function Handle(): State
    {
        echo '当前是B状态', PHP_EOL;
        return new ConcreteStateA();
    }
}

$c = new Context();
$stateA = new ConcreteStateA();
$c->SetState($stateA);
$c->Request();
$c->Request();
$c->Request();
$c->Request();

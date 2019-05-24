<?php

class Invoker
{
    public $command;
    
    public function __construct($command)
    {
        $this->command = $command;
    }

    public function exec()
    {
        $this->command->execute();
    }
}

abstract class Command
{
    protected $receiver;

    public function __construct(Receiver $receiver)
    {
        $this->receiver = $receiver;
    }

    abstract public function execute();
}

class ConcreteCommand extends Command
{
    public function execute()
    {
        $this->receiver->action();
    }
}

class Receiver
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function action()
    {
        echo $this->name . '命令执行了！', PHP_EOL;
    }
}

// 准备执行者
$receiverA = new Receiver('A');

// 准备命令
$command = new ConcreteCommand($receiverA);

// 请求者
$invoker = new Invoker($command);
$invoker->exec();

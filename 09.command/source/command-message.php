<?php

class SendMsg
{
    private $command = [];

    public function setCommand(Command $command)
    {
        $this->command[] = $command;
    }
    
    public function send($msg)
    {
        foreach ($this->command as $command) {
            $command->execute($msg);
        }
    }
}

abstract class Command
{
    protected $receiver = [];

    public function setReceiver($receiver)
    {
        $this->receiver[] = $receiver;
    }

    abstract public function execute($msg);
}

class SendAliYun extends Command
{
    public function execute($msg)
    {
        foreach ($this->receiver as $receiver) {
            $receiver->action($msg);
        }
    }
}

class SendJiGuang extends Command
{
    public function execute($msg)
    {
        foreach ($this->receiver as $receiver) {
            $receiver->action($msg);
        }
    }
}

class SendAliYunMsg
{
    public function action($msg)
    {
        echo '【阿X云短信】发送：' . $msg, PHP_EOL;
    }
}

class SendAliYunPush
{
    public function action($msg)
    {
        echo '【阿X云推送】发送：' . $msg, PHP_EOL;
    }
}

class SendJiGuangMsg
{
    public function action($msg)
    {
        echo '【极X短信】发送：' . $msg, PHP_EOL;
    }
}

class SendJiGuangPush
{
    public function action($msg)
    {
        echo '【极X推送】发送：' . $msg, PHP_EOL;
    }
}

$aliMsg = new SendAliYunMsg();
$aliPush = new SendAliYunPush();
$jgMsg = new SendJiGuangMsg();
$jgPush = new SendJiGuangPush();

$sendAliYun = new SendAliYun();
$sendAliYun->setReceiver($aliMsg);
$sendAliYun->setReceiver($aliPush);

$sendJiGuang = new SendJiGuang();
$sendAliYun->setReceiver($jgMsg);
$sendAliYun->setReceiver($jgPush);

$sendMsg = new SendMsg();
$sendMsg->setCommand($sendAliYun);
$sendMsg->setCommand($sendJiGuang);

$sendMsg->send('这次要搞个大活动，快来注册吧！！');

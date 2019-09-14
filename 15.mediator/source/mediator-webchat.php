<?php

abstract class Mediator
{
    abstract public function Send($message, $user);
}

class ChatMediator extends Mediator
{
    public $users = [];
    public function Attach($user)
    {
        if (!in_array($user, $this->users)) {
            $this->users[] = $user;
        }
    }

    public function Detach($user)
    {
        $position = 0;
        foreach ($this->users as $u) {
            if ($u == $user) {
                unset($this->users[$position]);
            }
            $position++;
        }
    }

    public function Send($message, $user)
    {
        foreach ($this->users as $u) {
            if ($u == $user) {
                continue;
            }
            $u->Notify($message);
        }
    }
}

abstract class User
{
    public $mediator;
    public $name;

    public function __construct($mediator, $name)
    {
        $this->mediator = $mediator;
        $this->name = $name;
    }
}

class ChatUser extends User
{
    public function Send($message)
    {
        $this->mediator->Send($message . '(' . $this->name . '发送)', $this);
    }
    public function Notify($message)
    {
        echo $this->name . '收到消息：' . $message, PHP_EOL;
    }
}

$m = new ChatMediator();

$u1 = new ChatUser($m, '用户1');
$u2 = new ChatUser($m, '用户2');
$u3 = new ChatUser($m, '用户3');

$m->Attach($u1);
$m->Attach($u3);
$m->Attach($u2);

$u1->Send('Hello, 大家好呀！'); // 用户2、用户3收到消息

$u2->Send('你好呀！'); // 用户1、用户3收到消息

$m->Detach($u2); // 用户2退出聊天室

$u3->Send('欢迎欢迎！'); // 用户1收到消息

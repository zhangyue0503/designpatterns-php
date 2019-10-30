<?php

interface ServiceVisitor
{
    public function SendMsg(SendMessage $s);
    function PushMsg(PushMessage $p);
}

class AliYun implements ServiceVisitor
{
    public function SendMsg(SendMessage $s)
    {
        echo '阿里云发送短信！', PHP_EOL;
    }
    public function PushMsg(PushMessage $p)
    {
        echo '阿里云推送信息！', PHP_EOL;
    }
}

class JiGuang implements ServiceVisitor
{
    public function SendMsg(SendMessage $s)
    {
        echo '极光发送短信！', PHP_EOL;
    }
    public function PushMsg(PushMessage $p)
    {
        echo '极光推送短信！', PHP_EOL;
    }
}

interface Message
{
    public function Msg(ServiceVisitor $v);
}

class PushMessage implements Message
{
    public function Msg(ServiceVisitor $v)
    {
        echo '推送脚本启动：';
        $v->PushMsg($this);
    }
}

class SendMessage implements Message
{
    public function Msg(ServiceVisitor $v)
    {
        echo '短信脚本启动：';
        $v->SendMsg($this);
    }
}

class ObjectStructure
{
    private $elements = [];

    public function Attach(Message $element)
    {
        $this->elements[] = $element;
    }

    public function Detach(Message $element)
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

    public function Accept(ServiceVisitor $visitor)
    {
        foreach ($this->elements as $e) {
            $e->Msg($visitor);
        }
    }

}

$o = new ObjectStructure();
$o->Attach(new PushMessage());
$o->Attach(new SendMessage());

$v1 = new AliYun();
$v2 = new JiGuang();

$o->Accept($v1);
$o->Accept($v2);

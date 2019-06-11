<?php

interface Message
{
    public function send();
}

class BaiduYunMessage implements Message
{
    function send()
    {
        echo '百度云发送信息！';
    }
}

class AliYunMessage implements Message
{
    public function send()
    {
        echo '阿里云发送信息！';
    }
}

class JiguangMessage implements Message
{
    public function send()
    {
        echo '极光发送信息！';
    }
}

class MessageContext
{
    private $message;
    public function __construct(Message $msg)
    {
        $this->message = $msg;
    }
    public function SendMessage()
    {
        $this->message->send();
    }
}

$bdMsg = new BaiduYunMessage();
$msgCtx = new MessageContext($bdMsg);
$msgCtx->SendMessage();

$alMsg = new AliYunMessage();
$msgCtx = new MessageContext($alMsg);
$msgCtx->SendMessage();

$jgMsg = new JiguangMessage();
$msgCtx = new MessageContext($jgMsg);
$msgCtx->SendMessage();



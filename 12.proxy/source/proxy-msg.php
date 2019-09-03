<?php

interface SendMessage
{
    public function Send();
}

class RealSendMessage implements SendMessage
{
    public function Send()
    {
        echo '短信发送中...', PHP_EOL;
    }
}

class ProxySendMessage implements SendMessage
{
    private $realSendMessage;

    public function __construct($realSendMessage)
    {
        $this->realSendMessage = $realSendMessage;
    }

    public function Send()
    {
        echo '短信开始发送', PHP_EOL;
        $this->realSendMessage->Send();
        echo '短信结束发送', PHP_EOL;
    }
}

$sendMessage = new ProxySendMessage(new RealSendMessage());
$sendMessage->Send();

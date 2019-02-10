<?php

interface Message {
    public function send(string $msg);
}

class AliYunMessage implements Message{
    public function send(string $msg){
        // 调用接口，发送短信
        // xxxxx
        return '阿里云短信（原阿里大鱼）发送成功！短信内容：' . $msg;
    }
}

class BaiduYunMessage implements Message{
    public function send(string $msg){
        // 调用接口，发送短信
        // xxxxx
        return '百度SMS短信发送成功！短信内容：' . $msg;
    }
}

class JiguangMessage implements Message{
    public function send(string $msg){
        // 调用接口，发送短信
        // xxxxx
        return '极光短信发送成功！短信内容：' . $msg;
    }
}


abstract class MessageFactory{
    abstract protected function factoryMethod();
    public function getMessage(){
        return $this->factoryMethod();
    }
}

class AliYunFactory extends MessageFactory{
    protected function factoryMethod(){
        return new AliYunMessage();
    }
}

class BaiduYunFactory extends MessageFactory{
    protected function factoryMethod(){
        return new BaiduYunMessage();
    }
}

class JiguangFactory extends MessageFactory{
    protected function factoryMethod(){
        return new JiguangMessage();
    }
}

// 当前业务需要使用百度云
$factory = new BaiduYunFactory();
$message = $factory->getMessage();
echo $message->send('您有新的短消息，请查收');
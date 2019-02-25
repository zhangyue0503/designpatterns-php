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

interface Push {
    public function send(string $msg);
}

class AliYunPush implements Push{
    public function send(string $msg){
        // 调用接口，发送客户端推送
        // xxxxx
        return '阿里云Android&iOS推送发送成功！推送内容：' . $msg;
    }
}

class BaiduYunPush implements Push{
    public function send(string $msg){
        // 调用接口，发送客户端推送
        // xxxxx
        return '百度Android&iOS云推送发送成功！推送内容：' . $msg;
    }
}

class JiguangPush implements Push{
    public function send(string $msg){
        // 调用接口，发送客户端推送
        // xxxxx
        return '极光推送发送成功！推送内容：' . $msg;
    }
}


interface MessageFactory{
    public function createMessage();
    public function createPush();
}

class AliYunFactory implements MessageFactory{
    public function createMessage(){
        return new AliYunMessage();
    }
    public function createPush(){
        return new AliYunPush();
    }
}

class BaiduYunFactory implements MessageFactory{
    public function createMessage(){
        return new BaiduYunMessage();
    }
    public function createPush(){
        return new BaiduYunPush();
    }
}

class JiguangFactory implements MessageFactory{
    public function createMessage(){
        return new JiguangMessage();
    }
    public function createPush(){
        return new JiguangPush();
    }
}

// 当前业务需要使用阿里云
$factory = new AliYunFactory();
// $factory = new BaiduYunFactory();
// $factory = new JiguangFactory();
$message = $factory->createMessage();
$push = $factory->createPush();
echo $message->send('您已经很久没有登录过系统了，记得回来哦！');
echo $push->send('您有新的红包已到帐，请查收！');
<?php

interface Subject
{
    public function Request();
}

class RealSubject implements Subject
{
    function Request()
    {
        echo "真实的操作", PHP_EOL;
    }
}

class Proxy implements Subject
{
    private $realSubject;

    public function __construct()
    {
        $this->realSubject = new RealSubject();
    }

    public function Request()
    {
        echo "代理的操作", PHP_EOL;
        $this->realSubject->Request();
    }
}

$proxy = new Proxy();
$proxy->Request();

// 远程代理：第三方接口SDK
// 虚代理：异步加载图片
// 保护代理&智能指引：权限保护
<?php

abstract class Cache
{
    private $config;
    private $conn;

    public function __construct()
    {
        $this->init();
    }
    public function init()
    {
        $this->GetConfig();
        $this->OpenConnection();
        $this->CheckConnection();
    }

    abstract public function GetConfig();
    abstract public function OpenConnection();
    abstract public function CheckConnection();
}

class MemcachedCache extends Cache
{
    public function GetConfig()
    {
        echo '获取Memcached配置文件！', PHP_EOL;
        $this->config = 'memcached';
    }
    public function OpenConnection()
    {
        echo '链接memcached!', PHP_EOL;
        $this->conn = 1;
    }
    public function CheckConnection()
    {
        if ($this->conn) {
            echo 'Memcached连接成功！', PHP_EOL;
        } else {
            echo 'Memcached连接失败，请检查配置项！', PHP_EOL;
        }
    }
}

class RedisCache extends Cache
{
    public function GetConfig()
    {
        echo '获取Redis配置文件！', PHP_EOL;
        $this->config = 'redis';
    }
    public function OpenConnection()
    {
        echo '链接redis!', PHP_EOL;
        $this->conn = 0;
    }
    public function CheckConnection()
    {
        if ($this->conn) {
            echo 'Redis连接成功！', PHP_EOL;
        } else {
            echo 'Redis连接失败，请检查配置项！', PHP_EOL;
        }
    }
}

$m = new MemcachedCache();

$r = new RedisCache();

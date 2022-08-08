<?php 

class HttpService{
    private static $instance;

    public function GetInstance(){
        if(self::$instance == NULL){
            self::$instance = new HttpService();
        }
        return self::$instance;
    }

    public function Post(){
        echo '发送Post请求', PHP_EOL;
    }

    public function Get(){
        echo '发送Get请求', PHP_EOL;
    }
}


$httpA = HttpService::GetInstance();
$httpA->Post();
$httpA->Get();

$httpB = HttpService::GetInstance();
$httpB->Post();
$httpB->Get();

var_dump($httpA === $httpB);
// 发送Post请求
// 发送Get请求
// 发送Post请求
// 发送Get请求
// bool(true)

$httpA = new HttpService();
$httpA->Post();
$httpA->Get();

$httpB = new HttpService();
$httpB->Post();
$httpB->Get();

var_dump($httpA === $httpB);
// 发送Post请求
// 发送Get请求
// 发送Post请求
// 发送Get请求
// bool(false)


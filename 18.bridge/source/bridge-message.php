<?php

interface MessageTemplate
{
    public function GetTemplate();
}

class LoginMessage implements MessageTemplate
{
    public function GetTemplate()
    {
        echo '您的登录验证码是【AAA】，请不要泄露给他人【XXX公司】！', PHP_EOL;
    }
}
class RegisterMessage implements MessageTemplate
{
    public function GetTemplate()
    {
        echo '您的注册验证码是【BBB】，请不要泄露给他人【XXX公司】！', PHP_EOL;
    }
}
class FindPasswordMessage implements MessageTemplate
{
    public function GetTemplate()
    {
        echo '您的找回密码验证码是【CCC】，请不要泄露给他人【XXX公司】！', PHP_EOL;
    }
}

abstract class MessageService
{
    protected $template;
    public function SetTemplate($template)
    {
        $this->template = $template;
    }
    abstract public function Send();
}

class AliYunService extends MessageService
{
    public function Send()
    {
        echo '阿里云开始发送短信：';
        $this->template->GetTemplate();
    }
}

class JiGuangService extends MessageService
{
    public function Send()
    {
        echo '极光开始发送短信：';
        $this->template->GetTemplate();
    }
}

// 三个短信模板
$loginTemplate = new LoginMessage();
$registerTemplate = new RegisterMessage();
$findPwTemplate = new FindPasswordMessage();

// 两个短信服务商
$aliYun = new AliYunService();
$jg = new JiGuangService();

// 随意组合
// 极光发注册短信
$jg->SetTemplate($registerTemplate);
$jg->Send();

// 阿里云发登录短信
$aliYun->SetTemplate($loginTemplate);
$aliYun->Send();

// 阿里云发找回密码短信
$aliYun->SetTemplate($findPwTemplate);
$aliYun->Send();

// 极光发登录短信
$jg->SetTemplate($loginTemplate);
$jg->Send();

// ......


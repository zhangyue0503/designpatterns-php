<?php
// 短信模板接口
interface MessageTemplate
{
    public function message();
}

// 假设有很多模板实现了上面的短信模板接口
// 下面这个是其中一个优惠券发送的模板实现
class CouponMessageTemplate implements MessageTemplate
{
    public function message()
    {
        return '优惠券信息：我们是全国第一的牛X产品哦，送您十张优惠券！';
    }
}

// 我们来准备好装饰上面那个过时的短信模板
abstract class DecoratorMessageTemplate implements MessageTemplate
{
    public $template;
    public function __construct($template)
    {
        $this->template = $template;
    }
}

// 过滤新广告法中不允许出现的词汇
class AdFilterDecoratorMessage extends DecoratorMessageTemplate
{
    public function message()
    {
        return str_replace('全国第一', '全国第二', $this->template->message());
    }
}

// 使用我们的大数据部门同事自动生成的新词库来过滤敏感词汇，这块过滤不是强制要过滤的内容，可选择使用
class SensitiveFilterDecoratorMessage extends DecoratorMessageTemplate
{
    public $bigDataFilterWords = ['牛X'];
    public $bigDataReplaceWords = ['好用'];
    public function message()
    {
        return str_replace($this->bigDataFilterWords, $this->bigDataReplaceWords, $this->template->message());
    }
}

// 客户端，发送接口，需要使用模板来进行短信发送
class Message
{
    public $msgType = 'old';
    public function send(MessageTemplate $mt)
    {
        // 发送出去咯
        if ($this->msgType == 'old') {
            echo '面向内网用户发送' . $mt->message() . PHP_EOL;
        } else if ($this->msgType == 'new') {
            echo '面向全网用户发送' . $mt->message() . PHP_EOL;
        }

    }
}

$template = new CouponMessageTemplate();
$message = new Message();

// 老系统，用不着过滤，只有内部用户才看得到
$message->send($template);

// 新系统，面向全网发布的，需要过滤一下内容哦
$message->msgType = 'new';
$template = new AdFilterDecoratorMessage($template);
$template = new SensitiveFilterDecoratorMessage($template);

// 过滤完了，发送吧
$message->send($template);

<?php

interface Observer
{
    public function update($obj);
}

class Message implements Observer
{
    //....

    function update($obj)
    {
        echo '发送新订单短信(' . $obj->mobile . ')通知给商家！';
    }

    //....
}

class Goods implements Observer
{
    //....

    public function update($obj)
    {
        echo '修改商品' . $obj->goodsId . '的库存！';
    }

    //....
}

class Order
{
    private $observers = [];
    public function attach($ob)
    {
        $this->observers[] = $ob;
    }

    public function detach($ob)
    {
        $position = 0;
        foreach ($this->observers as $ob) {
            if ($ob == $observer) {
                array_splice($this->observers, ($position), 1);
            }
            ++$position;
        }
    }
    public function notify($obj)
    {
        foreach ($this->observers as $ob) {
            $ob->update($obj);
        }
    }
    public function sale()
    {
        // 商品卖掉了
        // ....
        $obj = new stdClass();
        $obj->mobile = '13888888888';
        $obj->goodsId = 'Order11111111';
        $this->notify($obj);
    }
}

$message = new Message();
$goods = new Goods();
$order = new Order();
$order->attach($message);
$order->attach($goods);

// 订单卖出了！！
$order->sale();

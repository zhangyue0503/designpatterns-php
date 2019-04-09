<?php

interface MsgIterator
{
    public function First();
    public function Next();
    public function IsDone();
    public function CurrentItem();
}

// 正向迭代器
class MsgIteratorAsc implements MsgIterator
{
    private $list;
    private $index;
    public function __construct($list)
    {
        $this->list = $list;
        $this->index = 0;
    }
    public function First()
    {
        $this->index = 0;
    }

    public function Next()
    {
        $this->index++;
    }

    public function IsDone()
    {
        return $this->index >= count($this->list);
    }

    public function CurrentItem()
    {
        return $this->list[$this->index];
    }
}

// 反向迭代器
class MsgIteratorDesc implements MsgIterator
{
    private $list;
    private $index;
    public function __construct($list)
    {
        // 反转数组
        $this->list = array_reverse($list);
        $this->index = 0;
    }
    public function First()
    {
        $this->index = 0;
    }

    public function Next()
    {
        $this->index++;
    }

    public function IsDone()
    {
        return $this->index >= count($this->list);
    }

    public function CurrentItem()
    {
        return $this->list[$this->index];
    }
}

interface Message
{
    public function CreateIterator($list);
}

class MessageAsc implements Message
{
    public function CreateIterator($list)
    {
        return new MsgIteratorAsc($list);
    }
}
class MessageDesc implements Message
{
    public function CreateIterator($list)
    {
        return new MsgIteratorDesc($list);
    }
}

// 要发的短信号码列表
$mobileList = [
    '13111111111',
    '13111111112',
    '13111111113',
    '13111111114',
    '13111111115',
    '13111111116',
    '13111111117',
    '13111111118',
];

// A服务器脚本或使用swoole发送正向的一半
$serverA = new MessageAsc();
$iteratorA = $serverA->CreateIterator($mobileList);

while (!$iteratorA->IsDone()) {
    echo $iteratorA->CurrentItem(), PHP_EOL;
    $iteratorA->Next();
}

// B服务器脚本或使用swoole同步发送反向的一半
$serverB = new MessageDesc();
$iteratorB = $serverB->CreateIterator($mobileList);

while (!$iteratorB->IsDone()) {
    echo $iteratorB->CurrentItem(), PHP_EOL;
    $iteratorB->Next();
}

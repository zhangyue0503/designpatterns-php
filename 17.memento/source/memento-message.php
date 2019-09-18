<?php

class Message
{
    private $content;
    private $to;
    private $state;
    private $time;

    public function __construct($to, $content)
    {
        $this->to = $to;
        $this->content = $content;
        $this->state = '未发送';
        $this->time = time();
    }

    public function Show()
    {
        echo $this->to, '---', $this->content, '---', $this->time, '---', $this->state, PHP_EOL;
    }

    public function CreateSaveSate()
    {
        $ss = new SaveState();
        $ss->SetState($this->state);
        return $ss;
    }

    public function SetSaveState($ss)
    {
        if ($this->state != $ss->GetState()) {
            $this->time = time();
        }
        $this->state = $ss->GetState();
    }

    public function SetState($state)
    {
        $this->state = $state;
    }

    public function GetState()
    {
        return $this->state;
    }

}

class SaveState
{
    private $state;
    public function SetState($state)
    {
        $this->state = $state;
    }
    public function GetState()
    {
        return $this->state;
    }
}

class StateContainer
{
    private $ss;
    public function SetSaveState($ss)
    {
        $this->ss = $ss;
    }
    public function GetSaveState()
    {
        return $this->ss;
    }
}

// 模拟短信发送
$mList = [];
$scList = [];
for ($i = 0; $i < 10; $i++) {
    $m = new Message('手机号' . $i, '内容' . $i);
    echo '初始状态：';
    $m->Show();

    // 保存初始信息
    $sc = new StateContainer();
    $sc->SetSaveState($m->CreateSaveSate());
    $scList[] = $sc;

    // 模拟短信发送，2发送成功，3发送失败
    $pushState = mt_rand(2, 3);
    $m->SetState($pushState == 2 ? '发送成功' : '发送失败');
    echo '发布后状态：';
    $m->Show();

    $mList[] = $m;
}

// 模拟另一个线程查找发送失败的并把它们还原到未发送状态
sleep(2);
foreach ($mList as $k => $m) {
    if ($m->GetState() == '发送失败') { // 如果是发送失败的，还原状态
        $m->SetSaveState($scList[$k]->GetSaveState());
    }
    echo '查询发布失败后状态：';
    $m->Show();
}

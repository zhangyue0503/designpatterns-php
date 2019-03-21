<?php

// 使用php的spl扩展函数包
// SplSubject，观察者对象
// SplObserver，观察者
// SplObjectStorage，存储对象
// http://www.php.net/manual/zh/book.spl.php

class ConcreteSubject implements SplSubject
{
    private $observers;
    private $data;

    public function setObservers()
    {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }
    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
    public function setData($dataNow)
    {
        $this->data = $dataNow;
    }
    public function getData()
    {
        return $this->data;
    }
}

class ConcreteObserver implements SplObserver
{
    public function update(SplSubject $subject)
    {
        echo $subject->getData() . PHP_EOL;
    }
}

class Client
{
    public function __construct()
    {
        $ob1 = new ConcreteObserver();
        $ob2 = new ConcreteObserver();
        $ob3 = new ConcreteObserver();

        $subject = new ConcreteSubject();
        $subject->setObservers();
        $subject->setData("Here's your data!");
        $subject->attach($ob1);
        $subject->attach($ob2);
        $subject->attach($ob3);
        $subject->notify();

        $subject->detach($ob3);
        $subject->notify();

        $subject->setData("More data that only ob1 and ob3 need.");
        $subject->detach($ob3);
        $subject->attach($ob2);
        $subject->notify();

    }
}

$worker = new Client();

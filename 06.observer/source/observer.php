<?php

interface Observer
{
    public function update(Subject $subject): void;
}

class ConcreteObserver implements Observer
{
    private $observerState = '';
    function update(Subject $subject): void
    {
        $this->observerState = $subject->getState();
        echo '执行观察者操作！当前状态：' . $this->observerState;
    }
}

class Subject
{
    private $observers = [];
    private $stateNow = '';
    public function attach(Observer $observer): void
    {
        array_push($this->observers, $observer);
    }
    public function detach(Observer $observer): void
    {
        $position = 0;
        foreach ($this->observers as $ob) {
            if ($ob == $observer) {
                array_splice($this->observers, ($position), 1);
            }
            ++$position;
        }
    }
    public function notify(): void
    {
        foreach ($this->observers as $ob) {
            $ob->update($this);
        }
    }
}

class ConcreteSubject extends Subject{
    public function setState($state)
    {
        $this->stateNow = $state;
        $this->notify();
    }

    public function getState()
    {
        return $this->stateNow;
    }
}
$observer = new ConcreteObserver();
$observer2 = new ConcreteObserver();
$subject = new ConcreteSubject();
$subject->attach($observer);

// $subject->setState('哈哈哈哈');
// $subject->detach($observer);
// $subject->setState('哈哈哈哈222');

$subject->attach($observer2);
$subject->setState('哈哈哈哈');
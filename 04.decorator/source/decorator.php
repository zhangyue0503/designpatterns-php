<?php

interface Component{
    public function operation();
}

class ConcreteComponent implements Component{
    public function operation(){
        echo "I'm face!" . PHP_EOL;
    }
}

abstract class Decorator implements Component{
    protected $component;
    public function __construct(Component $component){
        $this->component = $component;
    }
}

class ConcreteDecoratorA extends Decorator{
    public $addedState = 1; // 没什么实际意义的属性，只是区别于ConcreteDecoratorB

    public function operation(){
        echo $this->component->operation() . "Push " . $this->addedState . " cream！" . PHP_EOL;
    }
}
class ConcreteDecoratorB extends Decorator{
    public function operation(){
        $this->component->operation();
        $this->addedBehavior();
    }

    // 没什么实际意义的方法，只是区别于ConcreteDecoratorA
    public function addedBehavior(){
        echo "Push 2 cream！" . PHP_EOL;
    }
}

// 被装饰对象
// $component = new ConcreteComponent();
// $component->operation(); // I'm face;

// // 装饰第一层
// $component = new ConcreteDecoratorA($component);
// $component->operation(); // I'm face \n Push 1 cream!

// // 装饰第二层
// $component = new ConcreteDecoratorB($component);
// $component->operation(); // I'm face \n Push 1 cream! \n Push 2 cream!

// ... 不断被装饰

// 直接一次全部装饰完
// 请把上方的三个$component->operation();注释掉再看看
$component2 = new ConcreteComponent(); // face
$component2 = new ConcreteDecoratorA($component2); // face 1
$component2 = new ConcreteDecoratorB($component2); // face 1 2
$component2->operation();
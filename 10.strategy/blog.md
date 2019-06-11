# PHP设计模式之策略模式

策略模式，又称为政策模式，属于行为型的设计模式。

## Gof类图及解释

***GoF定义：定义一系列的算法，把它们一个个封装起来，并且使它们可以相互替换。本模式使得算法可独立于使用它的客户而变化 。***

> GoF类图

![命令模式](https://raw.githubusercontent.com/zhangyue0503/designpatterns-php/master/09.command/img/command.jpg)


> 代码实现

```php
interface Strategy{
    function AlgorithmInterface();
}

class ConcreteStrategyA implements Strategy{
    function AlgorithmInterface(){
        echo "算法A";
    }
}

class ConcreteStrategyB implements Strategy{
    function AlgorithmInterface(){
        echo "算法B";
    }
}

class ConcreteStrategyC implements Strategy{
    function AlgorithmInterface(){
        echo "算法C";
    }
}
```

定义算法抽象及实现。

```php
class Context{
    private $strategy;
    function __construct(Strategy $s){
        $this->strategy = $s;
    }
    function ContextInterface(){
        
        $this->strategy->AlgorithmInterface();
    }
}
```

定义执行环境上下文。

```php
$strategyA = new ConcreteStrategyA();
$context = new Context($strategyA);
$context->ContextInterface();

$strategyB = new ConcreteStrategyB();
$context = new Context($strategyB);
$context->ContextInterface();

$strategyC = new ConcreteStrategyC();
$context = new Context($strategyC);
$context->ContextInterface();
```

最后，在客户端按需调用合适的算法。

- 是不是非常简单的一个设计模式。大家有没有发现这个模式和我们最早讲过的**简单工厂**非常类似
- 那么他们的区别呢？
- 工厂相关的模式属于创建型模式，顾名思义，这种模式是用来创建对象的，返回的是new出来的对象。要调用对象的什么方法是由客户端来决定的
- 而策略模式属性行为型模式，通过执行上下文，将要调用的函数方法封装了起来，客户端只需要调用执行上下文的方法就可以了
- 在这里，我们会发现，需要客户端来实例化具体的算法类，貌似还不如**简单工厂**好用，既然这样的话，大家何不尝试一下结合工厂和策略模式一起来实现一个模式呢？
- 作为思考题将这个实现留给大家，提示：将Context类的__construct变成一个简单工厂方法

**完整代码：[https://github.com/zhangyue0503/designpatterns-php/blob/master/10.strategy/source/strategy.php](https://github.com/zhangyue0503/designpatterns-php/blob/master/10.strategy/source/strategy.php)**

```php
<?php

class Invoker
{
    private $command = [];

    public function setCommand(Command $command)
    {
        $this->command[] = $command;
    }

    public function exec()
    {
        if(count($this->command) > 0){
            foreach ($this->command as $command) {
                $command->execute();
            }
        }
    }

    public function undo()
    {
        if(count($this->command) > 0){
            foreach ($this->command as $command) {
                $command->undo();
            }
        }
    }
}

abstract class Command
{
    protected $receiver;
    protected $state;
    protected $name;

    public function __construct(Receiver $receiver, $name)
    {
        $this->receiver = $receiver;
        $this->name = $name;
    }

    abstract public function execute();
}

class ConcreteCommand extends Command
{
    public function execute()
    {
        if (!$this->state || $this->state == 2) {
            $this->receiver->action();
            $this->state = 1;
        } else {
            echo $this->name . '命令正在执行，无法再次执行了！', PHP_EOL;
        }

    }
    
    public function undo()
    {
        if ($this->state == 1) {
            $this->receiver->undo();
            $this->state = 2;
        } else {
            echo $this->name . '命令未执行，无法撤销了！', PHP_EOL;
        }
    }
}

class Receiver
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function action()
    {
        echo $this->name . '命令执行了！', PHP_EOL;
    }
    public function undo()
    {
        echo $this->name . '命令撤销了！', PHP_EOL;
    }
}

// 准备执行者
$receiverA = new Receiver('A');
$receiverB = new Receiver('B');
$receiverC = new Receiver('C');

// 准备命令
$commandOne = new ConcreteCommand($receiverA, 'A');
$commandTwo = new ConcreteCommand($receiverA, 'B');
$commandThree = new ConcreteCommand($receiverA, 'C');

// 请求者
$invoker = new Invoker();
$invoker->setCommand($commandOne);
$invoker->setCommand($commandTwo);
$invoker->setCommand($commandThree);
$invoker->exec();
$invoker->undo();

// 新加一个单独的执行者，只执行一个命令
$invokerA = new Invoker();
$invokerA->setCommand($commandOne);
$invokerA->exec();

// 命令A已经执行了，再次执行全部的命令执行者，A命令的state判断无法生效
$invoker->exec();
```

- 这一次我们一次性解决了多个订单、多位厨师的问题，并且还顺便解决了如果下错命令了，进行撤销的问题
- 可以看出来，命令模式将调用操作的对象与知道如何实现该操作的对象实现了解耦
- 这种多命令多执行者的实现，有点像**组合模式**的实现
- 在这种情况下，增加新的命令，即不会影响执行者，也不会影响客户。当有新的客户需要新的命令时，只需要增加命令和请求者即可。即使有修改的需求，也只是修改请求者。
- Laravel框架的事件调度机制中，除了观察者模式外，也很明显的能看出命令模式的影子

*我们的手机工厂和餐厅其实并没有什么两样，当我们需要代工厂来制作手机时，也是先下订单，这个订单就可以看做是命令。在这个订单中，我们会规定好需要用到的配件，什么型号的CPU，什么型号的内存，预装什么系统之类的。然后代工厂的工人们就会根据这个订单来进行生产。在这个过程中，我不用关心是某一个工人还是一群工人来执行这个订单，我只需要将这个订单交给和我们对接的人就可以了，然后只管等着手机生产出来进行验收咯！！*

**完整代码：[https://github.com/zhangyue0503/designpatterns-php/blob/master/09.command/source/command-up.php](https://github.com/zhangyue0503/designpatterns-php/blob/master/09.command/source/command-up.php)**

## 实例

短信功能又回来了，我们发现除了工厂模式外，命令模式貌似也是一种不错的实现方式哦。在这里，我们依然是使用那几个短信和推送的接口，话不多说，我们用命令模式再来实现一个吧。当然，有兴趣的朋友可以接着实现我们的短信撤回功能哈，想想上面的命令取消是怎么实现的。

> 短信发送类图

![短信发送命令模式版](https://raw.githubusercontent.com/zhangyue0503/designpatterns-php/master/09.command/img/command-message.jpg)


**完整源码：[https://github.com/zhangyue0503/designpatterns-php/blob/master/09.command/source/command-message.php](https://github.com/zhangyue0503/designpatterns-php/blob/master/09.command/source/command-message.php)**

```php
<?php

class SendMsg
{
    private $command = [];

    public function setCommand(Command $command)
    {
        $this->command[] = $command;
    }
    
    public function send($msg)
    {
        foreach ($this->command as $command) {
            $command->execute($msg);
        }
    }
}

abstract class Command
{
    protected $receiver = [];

    public function setReceiver($receiver)
    {
        $this->receiver[] = $receiver;
    }

    abstract public function execute($msg);
}

class SendAliYun extends Command
{
    public function execute($msg)
    {
        foreach ($this->receiver as $receiver) {
            $receiver->action($msg);
        }
    }
}

class SendJiGuang extends Command
{
    public function execute($msg)
    {
        foreach ($this->receiver as $receiver) {
            $receiver->action($msg);
        }
    }
}

class SendAliYunMsg
{
    public function action($msg)
    {
        echo '【阿X云短信】发送：' . $msg, PHP_EOL;
    }
}

class SendAliYunPush
{
    public function action($msg)
    {
        echo '【阿X云推送】发送：' . $msg, PHP_EOL;
    }
}

class SendJiGuangMsg
{
    public function action($msg)
    {
        echo '【极X短信】发送：' . $msg, PHP_EOL;
    }
}

class SendJiGuangPush
{
    public function action($msg)
    {
        echo '【极X推送】发送：' . $msg, PHP_EOL;
    }
}

$aliMsg = new SendAliYunMsg();
$aliPush = new SendAliYunPush();
$jgMsg = new SendJiGuangMsg();
$jgPush = new SendJiGuangPush();

$sendAliYun = new SendAliYun();
$sendAliYun->setReceiver($aliMsg);
$sendAliYun->setReceiver($aliPush);

$sendJiGuang = new SendJiGuang();
$sendAliYun->setReceiver($jgMsg);
$sendAliYun->setReceiver($jgPush);

$sendMsg = new SendMsg();
$sendMsg->setCommand($sendAliYun);
$sendMsg->setCommand($sendJiGuang);

$sendMsg->send('这次要搞个大活动，快来注册吧！！');

```

> 说明

- 在这个例子中，依然是多命令多执行者的模式
- 可以将这个例子与抽象工厂进行对比，同样的功能使用不同的设计模式来实现，但是要注意的是，抽象工厂更多的是为了生产对象返回对象，而命令模式则是一种行为的选择
- 我们可以看出命令模式非常适合形成命令队列，多命令让命令可以一条一条执行下去
- 它允许接收的一方决定是否要否决请求，Receiver做为实现者拥有更多的话语权

## 下期看点

命令模式说了很多，不过确实是很好玩的一个模式，下一场我们休息休息，来一个比较简单的模式，甚至是比我们的**简单工厂**还要简单的一个模式，那就是**策略模式**
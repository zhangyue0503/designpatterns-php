# PHP设计模式之装饰器模式

工厂模式告一段落，我们来研究其他一些模式。不知道各位大佬有没有尝试过女装？据说女装大佬程序员很多哟。其实，今天的装饰器模式就和化妆这件事很像。相信如果有程序媛MM在的话，马上就能和你讲清楚这个设计模式。

## Gof类图及解释

装饰这两个字，我们暂且把他变成化妆。首先你得有一张脸，然后打底，然后上妆，可以早上来个淡妆上班，也可以下班的时候补成浓妆出去嗨。当然，码农们下班的时间点正好是能赶上夜场的下半场的。话说回来，不管怎么化妆，你的脸还是你的脸，有可能可以化成别人不认识的另一个人，但这的的确确还是你的脸。这就是装饰器，对对象（脸）进行各种装饰（化妆），让这个脸更好看（增加职责）。

***GoF定义：动态地给一个对象添加一些额外的职责，就增加功能来说，Decorator模式相比生成子类更为灵活***

> GoF类图

![装饰器方法结构类图]()

> 代码实现

```php
interface Component{
    public function operation();
}

class ConcreteComponent implements Component{
    public function operation(){
        echo "I'm face!" . PHP_EOL;
    }
}
```

很简单的一个接口和一个实现，这里我们就把具体的实现类看作是一张脸吧！

```php
abstract class Decorator implements Component{
    protected $component;
    public function __construct(Component $component){
        $this->component = $component;
    }
}
```

抽象的装饰者类，实现Component接口，但并不实现operation()方法，让子类去实现。在这里主要保存一个Componet的引用，一会就要对他进行装饰。对应到上方的具体类，我们就是要准备给脸化妆啦！

```php
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
```

两个具体装饰者。在这里我是涂了两次霜，毕竟是纯爷们，对化妆这事儿真的是不了解。好像第一步应该先是打粉底吧？不过这次就这样，我们这两个装饰器实现的就是给脸上涂两层霜。

- 从代码中可以看出，我们是一直对具体的那个ConcreteComponent对象来进行包装
- 再往下的话其实我们是对他的operation()这个方法包装了两次，每次都是在前一次的基础上加了一点点东西
- 不要纠结于A和B装饰器上的added属性和方法，他们只是GoF类图中用以区别这两个装饰器不是同一个东西，每个装饰器都可以干很多别的事，Component对象也不一定只有operation()这一个方法，我们可以选择性的去装饰对象中的全部或者部分方法
- 好像我们都继承了Component，直接子类一路重写不就行了，搞这费劲干嘛？亲，了解下组合的概念哟，我们的Decorator父类里面是一个真实对象的引用哦，解耦了自身哦，我们只给真实的对象去做包装，您可别直接实例化装饰器来直接用
- 还是没懂？好处呢？老系统的类啊、方法啊你敢随便乱改？想给前任写的牛(S)逼(B)代码扩展新功能时不妨试试装饰器这货，说不定有奇效！

*手机这玩意干不过某米、某O、某为，这没法玩呀，好吧，哥们去专心做手机壳吧！嗯，我先准备了一个透明壳（Component），貌似有点丑，没办法，谁叫哥们穷。给某米的加上各种纯色（DecoratorA1），然后背后印上各种颜色的植物（DecoratorB1）吧；某O的手机最近喜欢找流量明显做代言，那我给他的手机壳就用各种炫彩色（DecoratorA2）和明星的卡通头像（DecoratorB2）；最后的某为，好像手机已经开始引领业界潮流了，折叠屏这玩意不是要砸我这卖手机壳的生意嘛！！好吧，哥不给你们做了，还是跟我的某米、某O混去吧！！*

**完整代码：[装饰器模式]()**

## 实例



> 短信发送类图

![短信发送装饰器方法]()


**完整源码：[短信发送装饰器方法]()**

> 说明

## 下期看点

又是大伽驾到，电源适配器了解吧？变压器总见过吧？你可能用过，也可能没用过，但你一定听说过的**适配器模式**。
# 简单工厂模式

先从简单工厂入门，其实不管是去面试以及面试他人的时候，在问到设计模式的时候，大多数人都会提到工厂模式。毫无疑问，工厂模式在设计模式中是最出名的也是应用最多的一种模式。在GoF设计模式中属于创建型的模式。

但是，能够说明白**简单工厂**、**工厂模式**、**抽象工厂模式**这三种模式的人还真能让面试官刮目相看。当然，我们也不排除很多的面试官也不一定能够很清楚这三种模式到底有什么区别。

## 解释

简单工厂，也称静态工厂，不属于GoF23种设计模式。但是可以说是所有的设计模式中大家可能最容易理解，也可能在你的代码中早就已经用过不知道多少次的一种设计模式了。我们先从一个最最简单的代码段来看。

```php
// Factory
class Factory
{
    public static function createProduct(string $type) : Product
    {
        $product = null;
        switch ($type) {
            case 'A':
                $product = new ProductA();
                break;
            case 'B':
                $product = new ProductB();
                break;
        }
        return $product;
    }
}
```

没错，核心点就是中间那段简单的switch代码，我们在返回值类型中固定为Product接口的实现。

*在这段代码中，使用了PHP新特性，**参数类型**及**返回值类型***

产品接口和产品实现

```php
// Products
interface Product
{
    public function show();
}

class ProductA implements Product
{
    public function show()
    {
        echo 'Show ProductA';
    }
}

class ProductB implements Product
{
    public function show()
    {
        echo 'Show ProductB';
    }
}
```

最后客户端的使用就很简单了

```php
// Client
$productA = Factory::createProduct('A');
$productB = Factory::createProduct('B');
$productA->show();
$productB->show();
```

从以上代码可以看出，其实这里就是一个工厂根据我们传入的字符串或者其他你自己定义的标识符，来返回对应的对象。比较规范的写法可能是所有产品都会去实现一个统一的接口，然后客户端只知道接口的方法统一调用即可。不规范的话也可以不使用接口，返回各种不同的对象，类似于外观（Facade）模式进行统一的门面管理。

![简单工厂01](https://raw.githubusercontent.com/zhangyue0503/designpatterns-php/master/01.simple-factory/%08img/simple-factory.jpg)

源码地址：[简单工厂基础类图实现](https://github.com/zhangyue0503/designpatterns-php/blob/master/01.simple-factory/source/simple-factory.php)

## 实例

场景：消息推送现在我们使用了三个商家的，分别是阿里云、百度云、极光，在不同业务中可能使用不同的推送机制，使用简单工厂可以方便的完成这个需求。

![简单工厂-消息发送](https://raw.githubusercontent.com/zhangyue0503/designpatterns-php/master/01.simple-factory/%08img/simple-factory-message.jpg)


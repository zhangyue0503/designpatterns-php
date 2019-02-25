<?php

// 商品A抽象接口
interface AbstractProductA
{
    public function show(): void;
}

// 商品A1实现
class ProductA1 implements AbstractProductA
{
    public function show(): void
    {
        echo 'ProductA1 is Show!' . PHP_EOL;
    }
}
// 商品A2实现
class ProductA2 implements AbstractProductA
{
    public function show(): void
    {
        echo 'ProductA2 is Show!' . PHP_EOL;
    }
}

// 商品B抽象接口
interface AbstractProductB
{
    public function show(): void;
}
// 商品B1实现
class ProductB1 implements AbstractProductB
{
    public function show(): void
    {
        echo 'ProductB1 is Show!' . PHP_EOL;
    }
}
// 商品B2实现
class ProductB2 implements AbstractProductB
{
    public function show(): void
    {
        echo 'ProductB2 is Show!' . PHP_EOL;
    }
}

// 抽象工厂接口
interface AbstractFactory
{
    // 创建商品A
    public function CreateProductA(): AbstractProductA;
    // 创建商品B
    public function CreateProductB(): AbstractProductB;
}

// 工厂1，实现商品A1和商品B1
class ConcreteFactory1 implements AbstractFactory
{
    public function CreateProductA(): AbstractProductA
    {
        return new ProductA1();
    }
    public function CreateProductB(): AbstractProductB
    {
        return new ProductB1();
    }
}

// 工厂2，实现商品A2和商品B2
class ConcreteFactory2 implements AbstractFactory
{
    public function CreateProductA(): AbstractProductA
    {
        return new ProductA2();
    }
    public function CreateProductB(): AbstractProductB
    {
        return new ProductB2();
    }
}

// 工厂一
$factory1 = new ConcreteFactory1();
$factory1ProductA = $factory1->CreateProductA();
$factory1ProductB = $factory1->CreateProductB();
$factory1ProductA->show();
$factory1ProductB->show();

// 工厂二
$factory2 = new ConcreteFactory2();
$factory2ProductA = $factory2->CreateProductA();
$factory2ProductB = $factory2->CreateProductB();
$factory2ProductA->show();
$factory2ProductB->show();
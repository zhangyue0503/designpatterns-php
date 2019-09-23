<?php

class Facade
{

    private $subStytemOne;
    private $subStytemTwo;
    private $subStytemThree;
    private $subStytemFour;
    public function __construct()
    {
        $this->subSystemOne = new SubSystemOne();
        $this->subSystemTwo = new SubSystemTwo();
        $this->subSystemThree = new SubSystemThree();
        $this->subSystemFour = new SubSystemFour();
    }

    public function MethodA()
    {
        $this->subSystemOne->MethodOne();
        $this->subSystemTwo->MethodTwo();
    }
    public function MethodB()
    {
        $this->subSystemOne->MethodOne();
        $this->subSystemTwo->MethodTwo();
        $this->subSystemThree->MethodThree();
        $this->subSystemFour->MethodFour();
    }
}

class SubSystemOne
{
    public function MethodOne()
    {
        echo '子系统方法一', PHP_EOL;
    }
}
class SubSystemTwo
{
    public function MethodTwo()
    {
        echo '子系统方法二', PHP_EOL;
    }
}
class SubSystemThree
{
    public function MethodThree()
    {
        echo '子系统方法三', PHP_EOL;
    }
}
class SubSystemFour
{
    public function MethodFour()
    {
        echo '子系统方法四', PHP_EOL;
    }
}

$facade = new Facade();
$facade->MethodA();
$facade->MethodB();

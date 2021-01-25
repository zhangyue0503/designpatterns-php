<?php

abstract class Component
{
    protected $name;

    public function __construct($name){
        $this->name = $name;
    }
    
    abstract public function Operation(int $depth);

    abstract public function Add(Component $component);

    abstract public function Remove(Component $component);
}

class Composite extends Component
{
    private $componentList;

    public function Operation($depth)
    {
        echo str_repeat('-', $depth) . $this->name . PHP_EOL;
        foreach ($this->componentList as $component) {
            $component->Operation($depth + 2);
        }
    }

    public function Add(Component $component)
    {
        $this->componentList[] = $component;
    }

    public function Remove(Component $component)
    {
        $position = 0;
        foreach ($this->componentList as $child) {
            if ($child == $component) {
                array_splice($this->componentList, ($position), 1);
            }
            ++$position;
        }
    }

    public function GetChild(int $i)
    {
        return $this->componentList[$i];
    }
}

class Leaf extends Component
{
    public function Add(Component $c)
    {
        echo 'Cannot add to a leaf' . PHP_EOL;
    }
    public function Remove(Component $c)
    {
        echo 'Cannot remove from a leaf' . PHP_EOL;
    }
    public function Operation(int $depth)
    {
        echo str_repeat('-', $depth) . $this->name . PHP_EOL;
    }
}

$root = new Composite("root");
$root->Add(new Leaf("Leaf A"));
$root->Add(new Leaf("Leaf B"));

$comp = new Composite("Composite X");
$comp->Add(new Leaf("Leaf XA"));
$comp->Add(new Leaf("Leaf XB"));

$root->Add($comp);

$comp2 = new Composite("Composite XY");
$comp2->Add(new Leaf("Leaf XYA"));
$comp2->Add(new Leaf("Leaf XYB"));

$comp->Add($comp2);

$root->Add(new Leaf("Leaf C"));

$leaf = new Leaf("Leaf D");
$root->Add($leaf);
$root->remove($leaf);

$root->Operation(1);

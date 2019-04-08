<?php
class MyIterator implements Iterator
{
    private $position = 0;
    private $list = [];

    public function __construct($list)
    {
        $this->position = 0;
        $this->list = $list;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {

        return $this->list[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->list[$this->position]);
    }
}

// Client
$list = [
    "a",
    "b",
    "c",
];
$it = new MyIterator($list);

foreach ($it as $key => $value) {
    var_dump($key, $value);
}

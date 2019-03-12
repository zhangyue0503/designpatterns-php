<?php

interface Target{
    function Request() : void;
}

class Adapter implements Target{
    private $adaptee;

    function __construct($adaptee){
        $this->adaptee = $adaptee;
    }

    function Request() : void {
        $this->adaptee->SpecificRequest();
    }
}

class Adaptee {
    function SpecificRequest() : void{
        echo "I'm China Standard！";
    }
}

// 我是Client
$adaptee = new Adaptee();
$adapter = new Adapter($adaptee);
$adapter->Request();

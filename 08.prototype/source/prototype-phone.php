<?php
interface ServiceProvicer
{
    public function getSystem();
}

class ChinaMobile implements ServiceProvicer
{
    public $system;
    public function getSystem(){
        return "中国移动" . $this->system;
    }
}
class ChinaUnicom implements ServiceProvicer
{
    public $system;
    public function getSystem(){
        return "中国联通" . $this->system;
    }
}

class Phone 
{
    public $service_province;
    public $cpu;
    public $rom;
}

class CMPhone extends Phone
{
    function __clone()
    {
        // $this->service_province = new ChinaMobile();
    }
}

class CUPhone extends Phone
{
    function __clone()
    {
        $this->service_province = new ChinaUnicom();
    }
}


$cmPhone = new CMPhone();
$cmPhone->cpu = "1.4G";
$cmPhone->rom = "64G";
$cmPhone->service_province = new ChinaMobile();
$cmPhone->service_province->system = 'TD-CDMA';
$cmPhone1 = clone $cmPhone;
$cmPhone1->service_province->system = 'TD-CDMA1';

var_dump($cmPhone);
var_dump($cmPhone1);
echo $cmPhone->service_province->getSystem();
echo $cmPhone1->service_province->getSystem();


$cuPhone = new CUPhone();
$cuPhone->cpu = "1.4G";
$cuPhone->rom = "64G";
$cuPhone->service_province = new ChinaUnicom();
$cuPhone->service_province->system = 'WCDMA';
$cuPhone1 = clone $cuPhone;
$cuPhone1->rom = "128G";
$cuPhone1->service_province->system = 'WCDMA1';

var_dump($cuPhone);
var_dump($cuPhone1);
echo $cuPhone->service_province->getSystem();
echo $cuPhone1->service_province->getSystem();

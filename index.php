<?php
$client = new SoapClient('http://footballpool.dataaccess.eu/data/info.wso?WSDL');
try{
    echo "<pre>";
    //print_r($client->__getFunctions());
    //$result = $client->coaches();
    //$arr=["bSelected"=>''];
    //$res2 = $client->AllPlayerNames($arr);
    //var_dump($result);
    //var_dump($res2);
    echo "</pre>";
}catch (SoapFault $exseption){
    echo $exception;
}


$client2 = new SoapClient('http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL');
$res3 = $client2->EnumValutes(true);
var_dump($res3);


?>

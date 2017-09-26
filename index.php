<?php
include('libs/config.php');
include('libs/function.php');

//SOAP client 1. Outpat without prarm
try
{
    $footballSoap = new FootballSoapClient(FOOTBALL_WSDL);
    $cities = $footballSoap->getCitiesHtml();
}
catch (Exception $exception){
    $msg = $exception;
}

//SOAP client 2. Outpat with param
try
{
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $date = $_POST['dateSoap'];
        if ($date)
        {
            $bankSoap = new BankSoapClient(BANK_WSDL);
            $bankSoap->getArrCurs($date);
            $resBankSoap = $bankSoap->getHtmlCurse();
        }
    }
}
catch (Exception $exception){
    $msg = $exception;
}

//CURL client 1. Outpat without prarm
$footballCurl = new FootballCurlClient();
$footballCurl->getCities();
$citiesCurl = $footballCurl->getHtml();

//CURL client 2. Outpat with param
$bankCurl = new BankCurlClient();
$bankCurl->getCurs('2017-09-26');

include('template/template.php');
?>

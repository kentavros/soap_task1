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
            $bankSoap->getObjCurs($date);
            $_SESSION['soap'] = $bankSoap->getHtmlCurse();//->After updating or sending the second form, the displayed data is not lost
        }
    }
}
catch (Exception $exception){
    $msg = $exception;
}

//CURL client 1. Outpat without prarm
try
{
    $footballCurl = new FootballCurlClient();
    $citiesCurl = $footballCurl->getHtml();
}
catch (Exception $exception)
{
    $msg = $exception;
}

//CURL client 2. Outpat with param
try
{
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $date = $_POST['dateCurl'];
        if ($date)
        {
            $bankCurl = new BankCurlClient();
            $_SESSION['curl'] = $bankCurl->getHtmlCurse($date);//->After updating or sending the second form, the displayed data is not lost
        }
    }
}
catch (Exception $exception)
{
    $msg = $exception;
}

include('template/template.php');
?>

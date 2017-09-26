<?php
$data = '2017-09-06'; // request data from the form
$soapUrl = "http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?op=GetCursOnDate";// asmx URL of WSDL
//$soapUser = "username";  //  username
//$soapPassword = "password";

$xml_post_string = 
    '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
    <GetCursOnDate xmlns="http://web.cbr.ru/">
    <On_date>'.$data.'</On_date>
    </GetCursOnDate>
    </soap:Body>
    </soap:Envelope>';




$headers = array(
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "SOAPAction: http://web.cbr.ru/GetCursOnDate", 
    "Content-length: ".strlen($xml_post_string),
);

$url = $soapUrl;

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch); 
curl_close($ch);

var_dump($response);

//$response1 = str_replace("<soap:Body>","",$response);
//$response2 = str_replace("</soap:Body>","",$response1);

//$parser = simplexml_load_string($response2);

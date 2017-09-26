<?php
class FootballCurlClient
{
    private $curl;
    private $soapUrl = 'http://footballpool.dataaccess.eu/data/info.wso?op=Cities';
    private $xml_post_string ='?xml version="1.0" encoding="utf-8"?>
                                <soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope">
                                  <soap:Body>
                                    <Cities xmlns="http://footballpool.dataaccess.eu">
                                    </Cities>
                                  </soap:Body>
                                </soap:Envelope>';
    private $headers = array(
        "POST /data/info.wso HTTP/1.1",
        "Host: footballpool.dataaccess.eu",
        "Content-Type: application/soap+xml; charset=utf-8",
    );
    private $contentLength;


    public function __construct()
    {
        $this->curl = curl_init();
        $this->contentLength = "Content-length: ".strlen($this->xml_post_string);
        array_push($this->headers, $this->contentLength);
    }

    public function getCities(){
        curl_setopt($this->curl, CURLOPT_URL, $this->soapUrl);
    }



}
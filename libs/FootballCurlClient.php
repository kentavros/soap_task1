<?php
class FootballCurlClient
{
    private $curl;
    private $cities;
    private $soapUrl = 'http://footballpool.dataaccess.eu/data/info.wso?op=Cities';
    private $xmlPostString ='<?xml version="1.0" encoding="utf-8"?>
                                <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                                  <soap:Body>
                                    <Cities xmlns="http://footballpool.dataaccess.eu">
                                    </Cities>
                                  </soap:Body>
                                </soap:Envelope>';
    private $headers = array(
        "Host: footballpool.dataaccess.eu",
        "Content-Type: text/xml; charset=utf-8"
    );

    /**
     * init curl handler
     * FootballCurlClient constructor.
     */
    public function __construct()
    {
        $this->curl = curl_init();
    }

    /**
     * get data with curl method - save to prop
     * @return mixed
     * @throws Exception
     */
    private function getCities(){
        curl_setopt($this->curl, CURLOPT_URL, $this->soapUrl);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->xmlPostString);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);

        $response = curl_exec($this->curl);
        curl_close($this->curl);
        if (!$response){
            throw new Exception(ERR_URL);
        }
        
        $response1 = str_replace("<soap:Body>", "", $response);
        $response2 = str_replace("</soap:Body>", "", $response1);
        $response3 = str_replace("<m:CitiesResult>", "", $response2);
        $response4 = str_replace("</m:CitiesResult>", "", $response3);
        $response5 = str_replace("m:", "", $response4);
        $cities = new SimpleXMLElement($response5);
        $this->cities = $cities->CitiesResponse->string;
        return $this->cities;
    }

    /**
     * Get HTML - string
     * @return string
     * @throws Exception
     */
    public function getHtml(){
        $this->getCities();
        if (!is_object($this->cities)){
            throw new Exception(ERR_URL);
        }
        $html ='<ul>';
        foreach($this->cities as $city)
        {
         $html .='<li>'.$city.'</li>';
        }
        $html .='<ul>';
        return $html;
    }
}

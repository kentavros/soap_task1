<?php
class FootballSoapClient
{
    private $objSoap;
    private $cities;

    /**
     * FootballSoapClient constructor.
     * @param $url
     * @throws Exception
     */
    public function __construct($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL))
        {
            $this->objSoap = new SoapClient($url);
        }
        else
        {
            throw new Exception(ERR_URL);
        }
    }

    /**
     * add to prop cities - array
     */
    private function getCities()
    {
        return $this->cities = $this->objSoap->Cities()->CitiesResult->string;
    }

    /**
     * return html string
     */
    public function getCitiesHtml(){
        $this->getCities();
        $html = '<ul>';
        if (!is_array($this->cities))
        {
            return false;
        }
        foreach ($this->cities as $city){
            $html .='<li>'.$city.'</li>';
        }
        $html .='</ul>';
        return $html;
    }
}

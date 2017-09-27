<?php
class BankSoapClient
{
    private $objSoap;
    private $curs;
    private $objCurse;

    /**
     * BankSoapClient constructor.
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
     * Get data from server and save to prop
     * @param $date
     * @return mixed
     * @throws Exception
     */
    private function getCurs($date)
    {
        date_default_timezone_set('Europe/Kiev');
        if (date('Y-m-d', strtotime($date)) == $date){
            $param['On_date'] = date($date);
            $this->curs = $this->objSoap->GetCursOnDate($param)->GetCursOnDateResult->any;
            return $this->curs;
        }
        else
        {
            throw new Exception(ERR_DATE);
        }

    }

    /**
     * get object - cursan save to prop
     * @param $date
     * @return mixed
     */
    private function getObjCurs($date)
    {
        $this->getCurs($date);
        $xmlObj = new SimpleXMLElement($this->curs);
        $this->objCurse = $xmlObj->ValuteData->ValuteCursOnDate;
        return $this->objCurse;
    }

    /**
     * get HTML - string
     * @return bool|string
     */
    public function getHtmlCurse($date)
    {
        $this->getObjCurs($date);
        if(is_object($this->objCurse)){
            $html = '<p>Date: '.$date.'</p>';
            $html .= '<table class="table">';
            $html .='<tr><th>Currency name</th><th>Nominal</th><th>Course</th><th>ISO Digital code</th><th>ISO Symbolic code</th></tr>';
            foreach ($this->objCurse as $val){
                $html .='<tr>';
                $html .='<td>'.$val->Vname.'</td><td>'.$val->Vnom.'</td><td>'.$val->Vcurs.'</td><td>'.$val->Vcode.'</td><td>'.$val->VchCode.'</td>';
                $html .='</tr>';
            }
            $html .= '</table>';
            return $html;
        }
        else
        {
            return false;
        }
    }
}

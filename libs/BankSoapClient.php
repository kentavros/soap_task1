<?php
class BankSoapClient
{
    private $objSoap;
    private $curs;
    private $objCurse;

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

    private function getCurs($date)
    {
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

    public function getArrCurs($date)
    {
        $this->getCurs($date);
        $xmlObj = new SimpleXMLElement($this->curs);
        $this->objCurse = $xmlObj->ValuteData->ValuteCursOnDate;
        return $this->objCurse;
    }

    public function getHtmlCurse()
    {
        if(is_object($this->objCurse)){
            $html = '<table class="table">';
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
<?php
session_start();
/**
 * WSDL links for clients
 */
define('FOOTBALL_WSDL', 'http://footballpool.dataaccess.eu/data/info.wso?WSDL');
define('BANK_WSDL', 'http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL');

/**
 * Error Messages
 */
define('ERR_URL', 'The requested address is not correct!');
define('ERR_DATE', 'Wrong date format!');
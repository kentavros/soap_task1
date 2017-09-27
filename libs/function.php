<?php
/**
 * Autoload class function
 */
function __autoload($class)
{
    $path = "libs/{$class}.php";
    if (file_exists($path))
    {
        require_once ($path);
    }
    else
    {
        die ("File {$class} not found!");
    }
}

/**
 * Get data from Session to display data
 * @return bool
 */
function getDataSoap()
{
    if (isset($_SESSION['soap']))
    {
        return $_SESSION['soap'];
    }
    else
    {
        return false;
    }
}

function getDataCurl()
{
    if (isset($_SESSION['curl']))
    {
        return $_SESSION['curl'];
    }
    else
    {
        return false;
    }
}
?>

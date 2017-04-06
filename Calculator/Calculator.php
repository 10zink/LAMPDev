<?php
require_once "functions.php";

session_start();
header("Access-Control-Allow-Origin: *");

$cmd = getValue("cmd", " ");
if($cmd == "add")
{
    $response = add();
    header('Content-type: application/json');
    echo json_encode($response);
}
else if($cmd == "sub")
{
    $response = subtract();
    header('Content-type: application/json');
    echo json_encode($response);
}
else //if all supported commands
{
    
}

function add()
{
    $total = getSessionValue("total", 0);
    $num = getValue("num", 0);
    $total = $total + $num;
    setSessionValue("total", $total);
    
    return array("total" =>$total);
}

function subtract()
{
    $total = getSessionValue("total", 0);
    $num = getValue("num", 0);
    $total = $total - $num;
    setSessionValue("total", $total);
    
    return array("total" =>$total);
}

?>
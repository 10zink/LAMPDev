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
    $total = getSessionValue("total", array());
    $flavor = getValue("flavor", " ");
    $total[] = $flavor;
    setSessionValue("total", $total);
    
    return array("total" =>$total);
}

function subtract()
{
    $total = getSessionValue("total", array());
    $flavor = getValue("flavor", " ");
    $newTotal = [];
    
    foreach ($total as $n)
    {
        if($n != $flavor)
        {
            $newTotal[] = $n;
        }
    }

    setSessionValue("total", $newTotal);
    
    return array("total" =>$newTotal);
}

?>
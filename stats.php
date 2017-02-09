<?php
require_once("../Utilities/functions.php");
    
$numbers = getValue("num", array(0));
$avg = averagenum($numbers);
$largest = maxnum($numbers);
$smallest = minnum($numbers);


echo "<p> Avg: $avg Max: $largest Min: $smallest </p>";
    
function averagenum($ary)
{
   
    $total = 0.0;
    foreach($ary as $num)
    {
        $total = $total + $num;
    }
    return $total/count($ary);

}    
    
function maxnum($ary)
{
   $largest = 0.0;
   foreach($ary as $num)
   {
       if($num > $largest)
       $largest = $num;
   }
    return $largest;
}


function minnum($ary)
{
    $smallest = 100000.0;
    foreach($ary as $num)
    {
        if($num < $smallest)
        $smallest = $num;
    }
    return $smallest;
}


    
    
    
?>
    
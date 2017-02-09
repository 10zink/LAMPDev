<?php

require_once("../Utilities/functions.php");

$Fname = getValue("firstname", "John");
$Lname = getValue("lastname", "Doe");
$numberbats = getValue("numberofatbats", 100);
$Nhits = getValue ("numberofhits", 30);
$Nhr = getValue("numberofhomerun", 5);




echo "Full name:" . $Fname ." ". $Lname;
echo "Batting Ave:" . battingAve($Nhits, $numberbats);
echo "Chance of hitting home runs:" . hrChance($Nhr, $numberbats);





function battingAve($Nhits, $numberbats)
{
    $total = 0.0;
    
    if($numberbats = 0)
    {
        return $total;
    }
    
    $total = $Nhits/$numberbats;
    
    if($total >= 0.3)
    {
        
        return  "<p style='color:". "rgb(255,0,0)"."'> $total</p>";
    }
    else { return  $total;}
}

#echo battingAve($Nhits, $numberbats);


function hrChance($Nhr, $numberbats)
{
    $num = 0.0;
     if($numberbats = 0)
    {
        return $num;
    }
    $num = ($Nhr /$numberbats);
    
    return $num;
    
}

#echo hrChance($Nhr, $numberbats);



?>
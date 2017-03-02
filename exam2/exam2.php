<?php
#Tenzin Khunkhyen
#exam 2
#How much gas


require_once "functions.php";

session_start();
header("Access-Control-Allow-Origin: *");


#initialize variables
$cmd = getValue("cmd", "");
$mpg = getValue("mpg", 0);
$tankSize = getValue("tankSize", 0);
$cost = getValue("cost", 0);
$distance = getValue("distance",0);

 

if ($cmd == "howMuchGas")
{
    $response = howMuchGas($mpg, $tankSize, $cost, $distance);
    header('Content-type: application/json');
    echo json_encode($response);
}


// list all supported commands
else{
  echo
  "
    <pre>
    
    Command: howMuchGas

    Description: 
        Returns number of tanks you must fill up on a trip 
        and the cost to do so.  NOTE: this assumes that when 
        you add gas to your tank you always fill it up.
    
    Parameters: 
            mpg - miles per gallon of your vehicle
            tankSize - how many gallons your tank holds
            cost = the cost of a gallon of gas
            distance = how many miles you will be traveling
            
            NOTE: An error should be printed if any of these
            paraeters is less than or equal to 0 or  not a valid number.

    Example:
        Query string: ?cmd=howMuchGas&mpg=1&tankSize=2&cost=10&distance=5
        Returns:  
            {'error':'','tanksFills':3,'totalCost':60}
</pre>            
  ";
}

function howMuchGas($mpg, $tankSize, $cost, $distance)
{
    $enteredDistance = $distance;   
    $error = "none";
    $tanksfilled = 1;
    $fulltank = (int)$tankSize;
    $fulltankcost = (float)$cost * (float)$tankSize;#(cost/per gallon)  * (gastank total gallons)
    $totalCost = $fulltankcost;
    $miles = (int)$mpg * (int)$tankSize; 
   
    if($mpg <= 0)
    {
        $error = "MPG is 0.";
        return array('error:'=>$error);
        break;
    }
    
    if($cost <= 0)
    {
        $error = "Cost is 0.";
        return array('error:'=>$error);
        break;
    }

    if($tankSize <= 0)
    {
        $error = "TankSize is 0.";
        return array('error:'=>$error);
        break;
    }
     
    if($enteredDistance <= 0)
    {
        $error = "Distance is 0.";
        return array('error:'=>$error);
        break;
    }
    
    while($distance > 0)     
    {
        $fulltank = (int)$fulltank - (int)$mpg;
      
        if($fulltank == 0)
        {
            $totalCost += $fulltankcost;
            $fulltank = $tankSize;
            $tanksfilled = $tanksfilled + 1;
        }
        
        $distance = $distance - $miles;
    }
    
    if($distance <= 0 and $fulltank == 1)
    {
        $totalCost += $fulltankcost;
        $tanksfilled = $tanksfilled + 1;
        
    }

    return array('error:'=>$error,'tanksFills:'=> $tanksfilled ,'totalCost:' =>$totalCost);
}




?>

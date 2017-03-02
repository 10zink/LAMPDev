<?php
#Tenzin Khunkhyen
#Assignment 2: BMI
#This program calculates your BMI from your height and weight


require_once "../Utilities/functions.php";

session_start();
header("Access-Control-Allow-Origin: *");


#initialize variables
$cmd = getValue("cmd", "");
$w = getValue("w", 0);
$h = getValue("h", 0);


#set command to bmi
if ($cmd == "bmi")
{
    $response = calculate($w, $h); #need to pass $w for weight and $h for height
    header('Content-type: application/json');
    echo json_encode($response);
}


// list all supported commands
else{
  echo
  "
    <pre>
    
    Command: bmi
      
            Description: calculates body mass index (BMI)
            
            Parameters: 
                w = weight in lbs (default 0)
                h = height in inches (default 0)

            Example:
                Query string: ?cmd=bmi&w=160&h=72
                Returns: {'w':72,'h':1.8,'bmi':22.222222222222,'status':'healty'}
</pre>            
  ";
}

function calculate($w, $h)
{
    #a possible alternative route might be to use AssocAry
    #$response['w'] = getValue("w", 0);
    #$response['h'] = getValue("h", 0);
    
     
    $w = $w * 0.45; #converts the lbs to kg
    $h = $h * 0.025; #coneverst the inches to meters
    
    #guard against a divide by zero error if the height/weight is entered as 0
    if ($h > 0 and $w > 0)
    {
        $bmi = $w/($h *$h);#calculating the BMI
    }
    else
    {
        $bmi = 0; #sets BMI to 0, if it runs into a divide by 0 error.
    }
    
    #Status creator
    if(!$bmi>=19 or !$bmi <=25)
    {
        $status = "Healthy";
    }else{
        $status = "Unhealthy";
    }
  
  
  
    #$response = $response['w'] / ($response['h'] * $response['h']);
    
    
    return array('w'=>$w, 'h'=>$h, 'bmi'=>$bmi,'status'=>$status);
}




?>

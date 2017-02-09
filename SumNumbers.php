<?php

require_once("../Utilities/functions.php");

#Create an array of numbers, include 0 to match position with value. 
$numbers = array(0,1,2,3,4,5,6,7,8,9,10);

#set the default value of start to 1
$Start = getValue("start", 1);
#set the default value of end to 10
$End = getValue("end", 10);

#create the total outside of the forloop
$total = 0;

#forloop puts the input start value as the starting point in array, same as end
for($count = $numbers[$Start]; $count <= $numbers[$End]; $count = $count + 1 )
{

#sets count (user input) as the starting point and adds to total
   $total = $numbers[$count] + $total; 
        
}

#prints out the total
echo "<p>$total</p>";



?>
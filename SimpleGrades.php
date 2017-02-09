<?php

#Tenzin Khunkhyen
#Assignment 1: SimpleGrades
#Server Side

    require_once("../Utilities/functions.php");

#Made an array of 5 grades.
$Grades[0] = getValue("Grade1", 0);
$Grades[1] = getValue("Grade2", 0);
$Grades[2] = getValue("Grade3", 0);
$Grades[3] = getValue("Grade4", 0);
$Grades[4] = getValue("Grade5", 0);


#set variables equal to the functions of the array Grades
$avg = averagenum($Grades);
$largest = maxnum($Grades);
$smallest = minnum($Grades);

echo
"
<html>
    <head> 
        <h1>Simple Grade Calculator!</h1>
    </head>
<body>
    <p> Average: $avg Maximum: $largest Minimum: $smallest </p>
    
</body>
</html>";
 
  
#Used the same methods from Stats 


#Average
function averagenum($ary)
{
    $total = 0.0;
    foreach($ary as $num)
    {
        $total = $total + $num;
    }
    return $total/count($ary);

}    


#Maximum
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


#Minimum
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
    

<?php
require_once "functions.php";
require_once 'dbloginStates.php';

session_start();
header("Access-Control-Allow-Origin: *");

// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$cmd = getValue("cmd", "");
if ($cmd == "getStates")
{
    $response = getStates($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if ($cmd == "addStates")
{
    $response = addStates($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if ($cmd == "deleteState")
{
    $response = deleteState($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}

else // list all supported commands
{
  echo
  "
    <pre>
        Command: getStates
      
            Description: Returns an array of all of the courses in the database
            
            Parameters: none

            Example:
                Query string: ?cmd=getStates
                Returns: 
    </pre>            
  ";
}

function getStates($conn)
{
    $result = $conn->query("SELECT * FROM States");
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) 
    {
        $rows[] = $r;
    }
    return $rows;
}

function addStates($conn)
{
    $stateAbbreviations = getValue("stateAbbreviations", "");
    $stateName = getValue("stateName", "");
    $statePopulation = getValue("statePopulation", "");
    
    if ($stateAbbreviations == "" && $stateName == "" && $statePopulation == "")
    {
        return array("error"=>"All fields are required");  
    }
    
    if(strlen($stateAbbreviations)>2 or strlen($stateAbbreviations)<2)
    {
        return array("error"=>"State Abbreivations must be only 2 characters!");
        
    }
    if(is_numeric($stateAbbreviations) == TRUE)
    {
        return array("error"=>"State Abbreivations must only be letters, not numbers!");
    }
    if(is_numeric($stateName) == TRUE)
    {
        return array("error"=>"State Names must only be letters, not numbers!");
    }
    if($statePopulation <= 0)
    {
        return array("error"=>"State Populations must be above 0!");
    }
    if(strlen($stateName)<4)
    {
        return array("error"=>"Please enter a valid State Name!");
    }
    
    else if($stateAbbreviations != "" && $stateName != "" && $statePopulation != "")
    {
        $stmt = $conn->prepare("INSERT INTO States(stateAbbreviations, stateName, statePopulation) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $stateAbbreviations, $stateName, $statePopulation);
        $stmt->execute();
        return getStates($conn);
    }
   
   
}

function deleteState($conn)
{
    $stateID = getValue("stateID", "");

    if ($stateID != "")
    {
        $stmt = $conn->prepare("DELETE FROM States WHERE StateID = ?");
        $stmt->bind_param("i", $stateID);
        $stmt->execute();
        return getStates($conn);
    }
    else 
    {
        return array("error"=>"All fields are required");    
    }
}



?>

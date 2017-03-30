<?php
require_once "functions.php";

session_start();
header("Access-Control-Allow-Origin: *");

$cmd = getValue("cmd", "");
if ($cmd == "guess")
{
    $response = guess();
    header('Content-type: application/json');
    echo json_encode($response);
}
else // list all supported commands
{
  echo
  "
    <pre>
        Command: guess
      
            Description: allows the user to guess a number from 1 to 10
            
            Parameters: num

            Example:
                Query string: ?cmd=guess&num=5 
                Returns: {'win': false, 'tooHigh': false, 'tooLow': true}
    </pre>            
  ";
}

function guess()
{
	$tooHigh = FALSE;
	$tooLow = FALSE;
	$win = FALSE;
		
	$ans = getSessionValue("answer", -1);
	if ($ans == -1)
	{
		$ans = rand(1, 10);
		setSessionValue("answer", $ans);
	}
	
	$guess = getValue("num", -1);
	if ($guess == $ans)
	{
		$win = TRUE;
		$ans = rand(1, 10);
		setSessionValue("answer", $ans);
	}
	else if ($guess > $ans)
	{
		$tooHigh = TRUE;
	}
	else 
	{
		$tooLow = TRUE;
	}
	
    return array("win"=>$win, "tooHigh"=>$tooHigh, "tooLow"=>$tooLow, "answer"=>$ans);
}

?>

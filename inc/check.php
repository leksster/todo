<?php 

include_once("db.php");

if(isset($_POST["id"]) && $_POST["uncheck"] == 1)
{		

	$change_status = $db->query("UPDATE tasks SET status=1 WHERE id=".$_POST['id']);
	
	if(!$change_status)
	{    
		//If mysql delete query was unsuccessful, output error 
		header('HTTP/1.1 500 Could not change status!');
		exit();
	}
}

elseif (isset($_POST["id"]) && $_POST["uncheck"] == 0) 
{

	$change_status = $db->query("UPDATE tasks SET status=0 WHERE id=".$_POST['id']);

	if(!$change_status)
	{    
		//If mysql delete query was unsuccessful, output error 
		header('HTTP/1.1 500 Could not change status!');
		exit();
	}
	$db->close(); //close db connection

}

else
{
	//Output error
	header('HTTP/1.1 500 Error occurred');
    exit();
}
?>

